<?php

namespace App\Http;

class Request
{
  private array $headers;
  private string $uri;
  private string $httpMethod;
  private array $postVars;
  private array $queryParams;

  public function __construct()
  {
    $this->header = getallheaders();
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->httpMethod = $_SERVER['REQUEST_METHOD'];
    $this->postVars = $_POST ?? [];
    $this->queryParams = $_GET ?? [];
  }

  public function getUri(): string
  {
    return $this->uri;
  }

  public function getHttpMethod(): string
  {
    return $this->httpMethod;
  }

  public function getPostVars(): array
  {
    return $this->postVars;
  }

  public function getQueryParams(): array
  {
    return $this->queryParams;
  }
}