<?php

require_once __DIR__ . '/app/Core/Router.php';
require_once __DIR__ . '/app/Controllers/HomeController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

$router = new Router();
$router->route();