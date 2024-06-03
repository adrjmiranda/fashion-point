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
  '/admin/dashboard/orders',
  'App\\Controllers\\Admin\\Dashboard@orders',
  ['App\\Middlewares\\RequireLogin']
);

$router->get(
  '/admin/dashboard/products',
  'App\\Controllers\\Admin\\Dashboard@products',
  ['App\\Middlewares\\RequireLogin']
);

$router->get(
  '/admin/dashboard/finalized-orders',
  'App\\Controllers\\Admin\\Dashboard@finalizedOrders',
  ['App\\Middlewares\\RequireLogin']
);

$router->get(
  '/admin/dashboard/users',
  'App\\Controllers\\Admin\\Dashboard@users',
  ['App\\Middlewares\\RequireLogin']
);

$router->get(
  '/admin/dashboard/administrators',
  'App\\Controllers\\Admin\\Dashboard@administrators',
  ['App\\Middlewares\\RequireLogin']
);