<?php

// // Login and Logout
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
  '/admin/dashboard/[session: %s]',
  'App\\Controllers\\Admin\\Dashboard@session',
  ['App\\Middlewares\\RequireLogin']
);

$router->get(
  '/admin/create-product',
  'App\\Controllers\\Admin\\Product@productForm',
  ['App\\Middlewares\\RequireLogin']
);

$router->post(
  '/admin/create-product',
  'App\\Controllers\\Admin\\Product@createProduct',
  ['App\\Middlewares\\RequireLogin']
);