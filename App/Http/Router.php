<?php

namespace App\Http;

use App\Middlewares\Queu;
use Exception;

class Router
{
  private Request $request;
  private static string $baseUrl;
  private static string $baseUri;
  private static array $routes;
  private static array $routePattern = [
    '%d' => '/^[0-9]+$/',
    '%s' => '/^[a-z\-]+$/',
    '%c' => '/^[a-z]$/',
    '?d' => '/^[0-9]+$/',
    '?s' => '/^[a-z\-]+$/',
    '?c' => '/^[a-z]$/'
  ];
  const DEFAULT_PATTERN = '/\[([^\]]*)\]/';

  public function __construct(string $baseUrl)
  {
    $this->request = new Request($this);
    self::$baseUrl = $baseUrl;
  }

  private function addRoute(string $httpMethod, array $uriContent, object $controller, string $method, array $middlewareList): void
  {
    $uri = $uriContent['base_uri'];
    $path = $uriContent['path'];
    $vars = $uriContent['vars'];

    if (!isset(self::$routes[$httpMethod])) {
      self::$routes[$httpMethod] = [
        $uri => [
          'path' => $path,
          'controller' => $controller,
          'method' => $method,
          'vars' => $vars,
          'middlewares' => $middlewareList
        ]
      ];
    } else {
      if (isset(self::$routes[$httpMethod][$uri])) {
        throw new Exception("Redeclaration of the same uri $uri for the same http $httpMethod method not accepted");
      }

      self::$routes[$httpMethod][$uri] = [
        'path' => $path,
        'controller' => $controller,
        'method' => $method,
        'vars' => $vars,
        'middlewares' => $middlewareList
      ];
    }
  }

  private function getUri(string $uri): array
  {
    $parts = explode('/', $uri);

    $alreadyFoundPattern = false;
    $optionalVariableAlreadyAdded = false;

    $path = '';
    $baseUri = '';
    $vars = [];

    foreach ($parts as $value) {
      if (preg_match(self::DEFAULT_PATTERN, $value, $matches)) {
        $alreadyFoundPattern = true;

        $standard = $matches[1];

        $var = explode(':', $standard)[0];
        $standard = explode(':', $standard)[1];

        $var = trim($var);
        $standard = trim($standard);

        if (!preg_match('/^[a-z_]+$/', $var)) {
          throw new Exception('The variable name can only contain lowercase letters or underscores');
        }

        $patternKeys = array_keys(self::$routePattern);

        if (!in_array($standard, $patternKeys)) {
          throw new Exception('Invalid variable type in dynamic route definition');
        }

        if ($standard[0] === '%' && $optionalVariableAlreadyAdded) {
          throw new Exception('An optional variable cannot be added before a non-optional variable');
        }

        if ($standard[0] === '?') {
          $optionalVariableAlreadyAdded = true;
        }

        $vars[$var] = null;

        if (!empty($value)) {
          $path .= '/' . $standard;
        }
      } else {
        if ($alreadyFoundPattern) {
          throw new Exception('The route cannot receive a dynamic parameter before a fixed route segment');
        }

        if (!empty($value)) {
          $path .= '/' . $value;
          $baseUri .= '/' . $value;
        }
      }
    }

    return [
      'path' => $path,
      'base_uri' => $baseUri,
      'vars' => $vars
    ];
  }

  private function getController(string $handle): object
  {
    $controllerNamespace = explode('@', $handle)[0];

    if (!class_exists($controllerNamespace)) {
      throw new Exception("Controller $controllerNamespace does not exist");
    }

    $controller = new $controllerNamespace();

    return $controller;
  }

  private function getMethod(string $handle): string
  {
    $controller = $this->getController($handle);
    $method = explode('@', $handle)[1];

    if (!method_exists($controller, $method)) {
      throw new Exception("Method $method does not exist in controller $controller");
    }

    return $method;
  }

  public function get(string $uri, string $handle, array $middlewareList = []): void
  {
    $uriContent = $this->getUri($uri);
    $controller = $this->getController($handle);
    $method = $this->getMethod($handle);

    $this->addRoute('GET', $uriContent, $controller, $method, $middlewareList);
  }

  public function post(string $uri, string $handle, array $middlewareList = []): void
  {
    $uriContent = $this->getUri($uri);
    $controller = $this->getController($handle);
    $method = $this->getMethod($handle);

    $this->addRoute('POST', $uriContent, $controller, $method, $middlewareList);
  }

  private function validateRequestUri(string $requestHttpMethod, string $requestUri): ?bool
  {
    $uriList = array_keys(self::$routes[$requestHttpMethod]);
    $pathParts = [];

    foreach ($uriList as $uriBase) {
      if (strpos($requestUri, $uriBase) !== false) {
        self::$baseUri = $uriBase;

        $requestUri = str_replace($uriBase, '', $requestUri);

        $path = self::$routes[$requestHttpMethod][$uriBase]['path'];

        $path = str_replace($uriBase, '', $path);

        $pathParts = explode('/', $path);
        $pathParts = array_filter($pathParts, function ($value) {
          return $value !== '';
        });
        $pathParts = array_values($pathParts);

        break;
      }
    }


    if (!empty($requestUri)) {
      $requestUriParts = explode('/', $requestUri);
      $requestUriParts = array_filter($requestUriParts, function ($value) {
        return $value !== '';
      });
      $requestUriParts = array_values($requestUriParts);

      if (count($requestUriParts) > count($pathParts)) {
        throw new Exception("Route $requestUri not found", 404);
      }

      for ($i = 0; $i < count($pathParts); $i++) {
        if (!isset($requestUriParts[$i]) && $pathParts[$i][0] === '?') {
          break;
        }

        if (!preg_match(self::$routePattern[$pathParts[$i]], $requestUriParts[$i])) {
          throw new Exception("Route with incorrect $requestUriParts[$i] parameter", 400);
        }
      }

      $varValues = array_pad($requestUriParts, count($pathParts), null);
      $varNames = array_keys(self::$routes[$requestHttpMethod][$uriBase]['vars']);

      $vars = array_combine($varNames, $varValues);

      $this->request->setVars($vars);
    }

    return true;
  }

  public function run(): Response
  {
    try {
      $requestHttpMethod = $this->request->getHttpMethod();
      $requestUri = $this->request->getUri();

      if (!isset(self::$routes[$requestHttpMethod])) {
        throw new Exception("Http $requestHttpMethod method not enabled", 405);
      }

      if (!$this->validateRequestUri($requestHttpMethod, $requestUri)) {
        throw new Exception("Route $requestUri not found", 404);
      }

      $controller = self::$routes[$requestHttpMethod][self::$baseUri]['controller'];
      $method = self::$routes[$requestHttpMethod][self::$baseUri]['method'];

      $middlewareList = self::$routes[$requestHttpMethod][self::$baseUri]['middlewares'];

      return (new Queu($controller, $method, $middlewareList))->next($this->request);
    } catch (Exception $e) {
      $response = new Response($e->getMessage(), $e->getCode());

      return $response;
    }
  }

  public function redirect(string $uri): never
  {
    $url = self::$baseUrl . $uri;
    header('location: ' . $url);
    exit;
  }
}