<?php

use App\Controllers\AuthenticateController;
use App\Controllers\HomeController;
use App\Helpers\Route;
use App\Helpers\RouteCollection; 
use App\Controllers\RegisterController;

$routes = new RouteCollection();


$routes->add('home', Route::get('/', [HomeController::class, 'index']));
//Bejelentkezés
$routes->add('login', Route::get('/login', [AuthenticateController::class, 'index']));
$routes->add('login.post', Route::post('/login/post', [AuthenticateController::class, 'login']));
$routes->add('logout', Route::get('/logout', [AuthenticateController::class, 'logout']));
//Regisztráció
$routes->add('register', Route::get('/register', [RegisterController::class, 'index']));
$routes->add('register.post', Route::post('/register/post', [RegisterController::class, 'register']));

?>