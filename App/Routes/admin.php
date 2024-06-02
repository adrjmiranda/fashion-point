<?php

use App\Http\Router;

$url = 'http://localhost:8000';

$router = new Router($url);

$router->get('/admin/login', 'App\\Controllers\\Admin\\Login@index');
$router->post('/admin/login', 'App\\Controllers\\Admin\\Login@login');