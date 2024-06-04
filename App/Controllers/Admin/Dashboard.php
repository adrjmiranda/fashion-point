<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;

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

    return $this->view($session, [
      'active' => $active
    ]);
  }
}