<?php

use App\Helpers\Router;
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../routes/web.php';
session_start();

Router::invoke($routes);