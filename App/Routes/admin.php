<?php

// Login and Logout
$router->get(
  '/admin/login',
  'App\\Controllers\\Admin\\Auth@index',
  ['App\\Middlewares\\RequireLogout']
);

$router->post(
  '/admin/login',
  'App\\Controllers\\Admin\\Auth@login',
  ['App\\Middlewares\\RequireLogout']
);

$router->get(
  '/admin/logout',
  'App\\Controllers\\Admin\\Auth@logout',
  ['App\\Middlewares\\RequireLogin']
);

// Dashboard
$router->get(
  '/admin/dashboard',
  'App\\Controllers\\Admin\\Dashboard@index',
  ['App\\Middlewares\\RequireLogin']
);