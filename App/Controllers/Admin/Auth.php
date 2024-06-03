<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Http\Request;
use App\Models\Admin;
use App\Config\Session;

class Auth extends Controller
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

  private function accessDenied(Request $request, string $email, string $password, string $errorField, string $errorMessage)
  {
    $fields = [
      'email' => $email,
      'password' => $password
    ];

    $errors = [
      $errorField => $errorMessage
    ];

    return $this->index($request, $fields, $errors);
  }

  public function login(Request $request)
  {
    $postVars = $request->getPostVars();

    $email = $postVars['email'] ?? '';
    $password = $postVars['password'] ?? '';

    $admin = new Admin;
    $admin->email = $email;
    $admin->password = $password;

    $data = $admin->getOne('email');

    if (!$data instanceof Admin) {
      return $this->accessDenied($request, $email, $password, 'email', 'Email not registered');
    }

    if (!password_verify($password, $data->password)) {
      return $this->accessDenied($request, $email, $password, 'password', 'Incorrect password');
    }

    Session::setLogin($data);

    $request->getRouter()->redirect('/admin/dashboard');
  }

  public function logout(Request $request)
  {
    Session::logout('admin');

    $request->getRouter()->redirect('/admin/login');
  }
}