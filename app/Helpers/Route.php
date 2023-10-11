<?php

namespace App\Helpers;

use Exception;

class Route
{
	public string $path = '/';
	private $controller;
	private $func;

	private $method = 'GET';

	/**
	 * @param string $path
	 * @param array  $action
	 */
	public function __construct(string $path, array $action)
	{
		if(!isset($action[0]) || !isset($action[1])) {
			throw new Exception("Route controller or function is not set");
		}

		$this->path = $path;
		$this->controller = $action[0];
		$this->func = $action[1];
	}

	public static function get(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('GET');
	}

	public static function post(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('POST');
	}

	public function handle(RouteCollection $routes, $method, ...$args)
	{
		$controller = $this->controller::resolve($routes);

		if($this->method !== $method) {
			throw new Exception("Method [$method] is not allowed. Allowed methods: $this->method");
		}

		call_user_func_array([$controller, $this->func], $args);
	}

	public function getPath() : string
	{
		return $this->path;
	}

	public function setPath(string $path) : self
	{
		$this->path = $path;

		return $this;
	}

	/**
	 * @param $method
	 * @return $this
	 */
	public function setMethod($method) : self
	{
		$this->method = $method;

		return $this;
	}
}