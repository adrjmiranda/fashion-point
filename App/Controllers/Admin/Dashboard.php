<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;

class Dashboard extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function orders(): mixed
  {
    return $this->view('orders');
  }

  public function products(): mixed
  {
    return $this->view('products');
  }

  public function finalizedOrders(): mixed
  {
    return $this->view('finalized-orders');
  }

  public function users(): mixed
  {
    return $this->view('users');
  }

  public function administrators(): mixed
  {
    return $this->view('administrators');
  }
}