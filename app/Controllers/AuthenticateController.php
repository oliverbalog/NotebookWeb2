<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\User;
use Exception;

class AuthenticateController extends Controller
{
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	public function index()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		return $this->view('login');
	}

	public function login()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		try {
			$validated = $this->validate([
				'email' => ['required', 'email'],
				'password' => ['required', 'string'],
			]);

			$user = User::query()
				->find('email', $validated['email']);

			if(!$user || !password_verify($validated['password'], $user['password'])) {
				Input::throwError('Hibás felhasználónév vagy jelszó!');
			}

			Auth::setSession($user);

		} catch(Exception $e) {
			return $this->view('login', [
				'errors' => $e->getMessage()
			]);
		}

		return redirect(route($this->routes->get('home')));
	}

	public function logout()
	{
		Auth::unsetSession();

		return redirect(route($this->routes->get('home')));
	}
}