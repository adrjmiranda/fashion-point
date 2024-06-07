<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;
use App\Models\Product as ProductModel;

class Dashboard extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function session(Request $request)
  {
    $session = $request->getVars()['session'] ?? 'orders';
    $active = $session;

    $data = [
      'active' => $active
    ];

    if ($session === 'products') {
      $product = new ProductModel;

      $products = $product->all();
      $data['products'] = $products;
    }

    return $this->view($session, $data);
  }
}