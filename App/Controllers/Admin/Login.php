<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function index()
  {
    $this->view('login');
  }
}