<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Http\Router;

// Init ENV File
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 1));
$dotenv->load();

// Global Session Settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

if ($_ENV['APPLICATION_STATUS'] === 'production') {
  ini_set('session.cookie_secure', 1);
}

ini_set('session.cookie_samesite', 'Strict');

// Start Application Of Routes
$baseUrl = 'http://localhost:8000';
$router = new Router($baseUrl);