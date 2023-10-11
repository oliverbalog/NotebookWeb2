<?php

use App\Helpers\Auth;
use App\Helpers\ReflectionResolver;
use App\Helpers\Route;

function app($class) : object
{
	return ReflectionResolver::resolve($class);
}


function auth() : Auth
{
	return app(Auth::class);
}

function route(Route $route, $id = null) : string
{
 	if(str_contains($route->getPath(), '{id}') !== false) {
 		return str_replace('{id}', $id, $route->getPath());
	}

	return $route->getPath();
}


function redirect(string $url, string $status = null) : void
{
	if($status) {
		$_SESSION['status'] = $status;
	}

	header('Location: ' . $url, true, 303);
	exit();
}


function view($view = null) : string
{
    return APP_ROOT . '/resources/views/' . $view;
}

function dd(...$params) : void
{
	echo"<pre>";
	foreach($params as $data) {
		var_dump($data);
		echo"<br>";
	}
	echo"</pre>";

	die();
}

function abort($code = 404) : void
{
	http_response_code($code);

	die();
}

function abort_if($boolean, $code = 404)
{
	if($boolean) {
		return abort($code);
	}
}

function isUrl($url) : bool
{
	return (bool) preg_match("/$url/", parse_url($_SERVER['REQUEST_URI'])['path']);
}

function isRoute(Route $route) : bool
{
	return $route->getPath() == parse_url($_SERVER['REQUEST_URI'])['path'];
}

function arrays_equals(array $a, array $b) : bool
{
	return (
		count($a) == count($b) &&
		array_diff($a, $b) === array_diff($b, $a)
	);
}

if (!function_exists('str_contains')) {
	function str_contains($haystack, $needle) {
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}