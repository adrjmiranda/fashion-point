<?php

namespace App\Http;

use Exception;

class Router
{
  private Request $request;
  private string $url;
  private array $routes;
  private array $middlewares;
  private string $contentType;

  public function __construct(string $url)
  {
    $this->request = new Request;
    $this->url = $url;
  }

  // public function setContentType(string $contentType)
  // {
  //   $this->contentType = $contentType;
  // }

  private function addRoute(string $httpMethod, string $uri, object $controller, string $method): void
  {
    if (!isset($this->routes[$httpMethod])) {
      $this->routes[$httpMethod] = [
        $uri => [
          $controller,
          $method
        ]
      ];
    } else {
      if (isset($this->routes[$httpMethod][$uri])) {
        throw new Exception("Redeclaration of the same uri $uri for the same http $httpMethod method not accepted");
      }

      array_push($this->routes[$httpMethod], [
        $uri => [
          $controller,
          $method
        ]
      ]);
    }
  }

  // public function addMiddleware(string $middleware)
  // {
  // }

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

  public function get(string $uri, string $handle): void
  {
    $controller = $this->getController($handle);
    $method = $this->getMethod($handle);

    $this->addRoute('GET', $uri, $controller, $method);
  }

  public function post(string $uri, string $handle): void
  {
    $controller = $this->getController($handle);
    $method = $this->getMethod($handle);

    $this->addRoute('POST', $uri, $controller, $method);
  }

  public function run(): Response
  {
    try {
      $requestHttpMethod = $this->request->getHttpMethod();
      $requestUri = $this->request->getUri();

      if (!isset($this->routes[$requestHttpMethod])) {
        throw new Exception("Http $requestHttpMethod method not enabled", 405);
      }

      if (!isset($this->routes[$requestHttpMethod][$requestUri])) {
        throw new Exception("Route $requestUri not found", 404);
      }

      $controller = $this->routes[$requestHttpMethod][$requestUri][0];
      $method = $this->routes[$requestHttpMethod][$requestUri][1];

      $content = $controller->$method();

      $response = new Response($content);

      return $response;
    } catch (Exception $e) {
      $response = new Response($e->getMessage(), $e->getCode());

      return $response;
    }
  }
}