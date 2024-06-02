<?php

namespace App\Controllers;

use App\Utils\View;

class Controller
{
  private View $template;

  public function __construct(string $viewBaseFolder)
  {
    $baseUrl = $_ENV['BASE_URL'];

    $this->template = new View($viewBaseFolder, $baseUrl);
  }

  protected function view(string $view, array $data = []): mixed
  {
    return $this->template->render($view, $data);
  }
}