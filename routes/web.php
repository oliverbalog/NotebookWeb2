<?php

use App\Controllers\AuthenticateController;
use App\Controllers\HomeController;
use App\Controllers\NewsController;
use App\Helpers\Route;
use App\Helpers\RouteCollection; 
use App\Controllers\RegisterController;
use App\Controllers\NotebookController;

$routes = new RouteCollection();


$routes->add('home', Route::get('/', [HomeController::class, 'index']));
//Bejelentkezés
$routes->add('login', Route::get('/login', [AuthenticateController::class, 'index']));
$routes->add('login.post', Route::post('/login/post', [AuthenticateController::class, 'login']));
$routes->add('logout', Route::get('/logout', [AuthenticateController::class, 'logout']));
//Regisztráció
$routes->add('register', Route::get('/register', [RegisterController::class, 'index']));
$routes->add('register.post', Route::post('/register/post', [RegisterController::class, 'register']));
//SOAP
$routes->add('notebooks.index', Route::get('/notebooks', [NotebookController::class, 'index']));
$routes->add('notebooks.create', Route::get('/notebooks/create', [NotebookController::class, 'create']));
$routes->add('notebooks.store', Route::post('/notebooks/store', [NotebookController::class, 'store']));
$routes->add('notebooks.show', Route::get('/notebooks/{id}', [NotebookController::class, 'show']));
$routes->add('notebooks.edit', Route::get('/notebooks/{id}/edit', [NotebookController::class, 'edit']));
$routes->add('notebooks.update', Route::post('/notebooks/{id}/update', [NotebookController::class, 'update']));
$routes->add('notebooks.delete', Route::get('/notebooks/{id}/delete', [NotebookController::class, 'delete']));

$routes->add('news.index', Route::get('/news', [NewsController::class, 'index']));
$routes->add('news.rate', Route::post('/news/{id}/rate', [NewsController::class, 'rate']));
$routes->add('news.store', Route::post('/news/store', [NewsController::class, 'store']));
?>