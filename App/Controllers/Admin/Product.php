<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;

class Product extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function productForm(Request $request): mixed
  {
    return $this->view('create-product');
  }

  public function createProduct(Request $request)
  {
  }
}