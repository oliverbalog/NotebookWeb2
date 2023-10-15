<?php

namespace App\Helpers;

use App\Models\User;

class Auth
{
	public static function make()
	{
		return (new static);
	}

	public static function check()
	{
		return isset($_SESSION['user_id']);
	}

	public static function id()
	{
		if(self::check()) {
			return (int) $_SESSION['user_id'];
		}

		return null;
	}

	public static function user() : ?object
	{
		if(self::check()) {
			return (object) User::query()->find(self::id());
		}

		return null;
	}

	public static function setSession(array $user) : void
	{
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_name'] = $user['name'];
		$_SESSION['user_email'] = $user['email'];
	}

	public static function unsetSession() : void
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_name']);
		session_destroy();
	}
}