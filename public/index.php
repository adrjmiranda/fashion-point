<?php

require_once __DIR__ . '/../bootstrap.php';

// Add Admin Routes
include_once __DIR__ . '/../App/Routes/admin.php';

$response = $router->run();

$response->sendResponse();