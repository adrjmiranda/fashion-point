<?php

namespace App\Config;

use App\Models\Admin;
use App\Models\User;

class Session
{
  private static function init(): void
  {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $_ENV['APPLICATION_STATUS'] === 'production' ? true : false,
        'httponly' => true,
        'samesite' => 'Strict'
      ]);

      session_start();

      if (!isset($_SESSION['initiated'])) {
        session_regenerate_id(true);
        $_SESSION['initiated'] = true;
      }
    }
  }



  public static function setLogin(object $data): void
  {
    self::init();

    $key = '';

    if ($data instanceof User) {
      $key = 'user';
    } elseif ($data instanceof Admin) {
      $key = 'admin';
    }

    if (!empty($key)) {
      $_SESSION[$key]['id'] = $data->id;
      $_SESSION[$key]['first_name'] = $data->first_name;
      $_SESSION[$key]['last_name'] = $data->last_name;
      $_SESSION[$key]['email'] = $data->email;
    }
  }

  public static function isLogged(string $key): bool
  {
    self::init();

    $logged = false;

    switch ($key) {
      case 'user':
        $logged = isset($_SESSION[$key]['id']);
        break;

      case 'admin':
        $logged = isset($_SESSION[$key]['id']);
        break;

      default:
        $logged = isset($_SESSION['user']['id']) || isset($_SESSION['admin']['id']);
        break;
    }

    return $logged;
  }

  public static function logout(string $key = ''): void
  {
    self::init();

    switch ($key) {
      case 'user':
        unset($_SESSION[$key]);
        break;

      case 'admin':
        unset($_SESSION[$key]);
        break;

      default:
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
          );
        }

        session_destroy();
        break;
    }
  }
}