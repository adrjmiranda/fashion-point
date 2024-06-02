<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;
use App\Models\Admin;
use App\Models\Model;
use Exception;

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct('Admin');
  }

  public function index(Request $request, array $fields = [], array $errors = []): mixed
  {
    return $this->view('login', [
      'fields' => $fields,
      'errors' => $errors
    ]);
  }

  public function login(Request $request)
  {
    $postVars = $request->getPostVars();

    $email = $postVars['email'] ?? '';
    $password = $postVars['password'] ?? '';

    $admin = new Admin;
    $admin->email = $email;
    $admin->password = $password;

    if (!$admin->getOne('email') instanceof Admin) {
      $fields = [
        'email' => $email,
        'password' => $password
      ];

      $errors = [
        'email' => 'Email not registered'
      ];

      return $this->index($request, $fields, $errors);
    }
  }
}