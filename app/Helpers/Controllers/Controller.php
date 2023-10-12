<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;

abstract class Controller
{
	protected RouteCollection $routes;

	protected $post;

	protected $folder = null;

	public function __construct(RouteCollection $routes)
	{
		$this->routes = $routes;
		$this->post = $_POST;
	}

	public static function resolve(RouteCollection $routes)
	{
		return (new static($routes));
	}

	public function validate(array $rules)
	{
		$post = $this->post;
		$validated = [];

		foreach($rules as $field => $rule) {

			if(is_string($rule) && str_contains($rule, '|')) {
				$rule = explode('|', $rule);
			}

			if(is_string($rule)) {
				$valid = Input::{$rule}($field, $post[$field]);
				$validated[$field] = $valid;
				continue;
			}

			if(is_array($rule)) {
				foreach($rule as $r) {
					$valid = Input::{$r}($field, $post[$field]);
					$validated[$field] = $valid; 
				}
			}
		}

		return $validated;
	}

	public function view(string $view, array $variables = [])
	{
		$routes = $this->routes;

		foreach($variables as $name => $data) {
			$$name = $data;
		}

		if(!str_contains($view, '.php')) {
			$view .= '.php';
		}

		if($folder = $this->folder) {
			$view = $folder . DIRECTORY_SEPARATOR . $view;
		}

		return require_once view($view);
	}
}