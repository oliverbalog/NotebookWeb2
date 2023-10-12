<?php

use App\Controllers\HomeController;
use App\Helpers\Route;
use App\Helpers\RouteCollection; 

$routes = new RouteCollection();


$routes->add('home', Route::get('/', [HomeController::class, 'index']));

?>