<?php

namespace App\Controllers;

use App\Utils\View;

class Controller
{
  private View $view;

  public function __construct(string $viewBaseFolder)
  {
    $this->view = new View($viewBaseFolder);
  }

  protected function view(string $view, array $data = [])
  {
    echo $this->view->render($view, $data);
  }
}