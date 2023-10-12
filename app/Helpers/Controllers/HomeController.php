<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;

class HomeController extends Controller
{
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	public function index()
	{
		return $this->view('home.php');
	}
}