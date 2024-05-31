<?php

namespace App\Utils;

use Exception;

class View
{
  private string $baseFolder;
  private ?string $content;
  private ?string $layout;
  private array $data = [];

  public function __construct($baseFolder)
  {
    $this->baseFolder = $baseFolder;
  }

  private function getFile(string $view): bool|string
  {
    if (!preg_match('/^[a-zA-Z0-9_\-]+$/', $view) || !preg_match('/^[a-zA-Z0-9_\-]+$/', $this->baseFolder)) {
      throw new Exception("Invalid template name.");
    }

    $view = $this->baseFolder . '/' . $view;

    $baseDir = realpath(__DIR__ . '/../Views');
    $file = realpath($baseDir . '/' . $view . '.php');

    if ($file === false || strpos($file, $baseDir) !== 0) {
      throw new Exception("Template $view not found or access denied.");
    }

    if (!file_exists($file)) {
      throw new Exception("Template $file not found.");
    }

    return $file;
  }

  public function render(string $view, array $data = []): mixed
  {
    ob_start();

    extract($data);

    require_once $this->getFile($view);

    $content = ob_get_contents();

    ob_end_clean();

    if (!empty($this->layout)) {
      $this->content = $content;

      $data = array_merge($this->data, $data);

      $layout = $this->layout;
      $this->layout = null;

      return $this->render($layout, $data);
    }


    return $content;
  }

  private function extend(string $layout, array $data = []): void
  {
    $this->layout = $layout;
    $this->data = $data;
  }

  private function load(): mixed
  {
    return !empty($this->content) ? $this->content : null;
  }
}