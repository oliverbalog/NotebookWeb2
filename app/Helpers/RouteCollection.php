<?php

namespace App\Helpers;

class RouteCollection implements \Countable
{
	private array $routes = [];

	public function count(): int
	{
		return count($this->routes);
	}

	public function all() : array
	{
		return $this->routes;
	}

	public function add(string $name, Route $route)
	{
		unset($this->routes[$name]);

		$this->routes[$name] = $route;
	}

	public function get(string $name) : ?Route
	{
		if(array_key_exists($name, $this->routes)) {
			return $this->routes[$name];
		}

		foreach($this->routes as $route) {
			if($route->getPath() == $name) {
				return $route;
			}
		}

		return null;
	}
}