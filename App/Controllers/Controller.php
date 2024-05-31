<?php

namespace App\Controllers;

use App\Utils\View;

class Controller
{
  private View $template;

  public function __construct(string $viewBaseFolder)
  {
    $this->template = new View($viewBaseFolder);
  }

  protected function view(string $view, array $data = []): void
  {
    echo $this->template->render($view, $data);
  }
}