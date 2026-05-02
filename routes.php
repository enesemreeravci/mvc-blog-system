<?php

require_once __DIR__ . '/app/Core/Router.php';
require_once __DIR__ . '/app/Core/Middleware.php';
require_once __DIR__ . '/app/Controllers/HomeController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/PostController.php';
require_once __DIR__ . '/app/Controllers/AdminController.php';
require_once __DIR__ . '/app/Controllers/AdminCategoryController.php';

$router = new Router();
$router->route();