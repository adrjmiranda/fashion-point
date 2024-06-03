<?php

namespace App\Middlewares;

use App\Http\Request;
use App\Http\Response;
use Exception;

class Queu
{
  private array $middlewares;
  private object $controller;
  private string $method;

  public function __construct(object $controller, string $method, array $middlewares = [])
  {
    $this->controller = $controller;
    $this->method = $method;
    $this->middlewares = $middlewares;
  }

  public function next(Request $request)
  {
    if (empty($this->middlewares)) {
      $controller = $this->controller;
      $method = $this->method;

      $content = $controller->$method($request);

      $response = new Response($content);

      return $response;
    }

    $middlewareNamespace = array_shift($this->middlewares);
    if (!class_exists($middlewareNamespace)) {
      throw new Exception("Failed to process request middleware", 500);
    }

    $queu = $this;
    $next = function ($request) use ($queu) {
      return $queu->next($request);
    };

    return (new $middlewareNamespace)->handle($request, $next);
  }
}