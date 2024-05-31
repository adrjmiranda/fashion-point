<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class Dashboard extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function index(): void
  {
    $this->view('dashboard', [
      'name' => 'Miranda'
    ]);
  }
}