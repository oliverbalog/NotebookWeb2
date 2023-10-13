<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../config/config.php';
use App\Helpers\Router;

session_start();

Router::invoke($routes);