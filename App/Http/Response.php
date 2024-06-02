<?php

namespace App\Http;

class Response
{
  private int $httpCode;
  private array $headers;
  private string $contentType;
  private mixed $content;

  public function __construct(mixed $content, int $httpCode = 200, string $contentType = 'text/html')
  {
    $this->content = $content;
    $this->setContentType($contentType);
    $this->httpCode = $httpCode;
  }

  private function setContentType(string $contentType)
  {
    $this->contentType = $contentType;
    $this->addHeaders('Content-Type', $contentType);
  }

  private function addHeaders(string $key, string $value)
  {
    $this->headers[$key] = $value;
  }

  private function sendHeaders()
  {
    http_response_code($this->httpCode);

    foreach ($this->headers as $key => $value) {
      header($key . ': ' . $value);
    }
  }

  public function sendResponse()
  {
    $this->sendHeaders();

    switch ($this->contentType) {
      case 'text/html':
        echo $this->content;
        break;

      default:
        # code...
        break;
    }
  }
}