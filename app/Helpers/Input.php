<?php

namespace App\Helpers;

use Exception;

class Input{
    static $errors = true;


	public static function check($arr, $on = false)
	{
		if($on === false) {
			$on = $_REQUEST;
		}
		foreach($arr as $value) {
			if(empty($on[$value])) {
				self::throwError(ucfirst($value) . ' field is required', 900);
			}
		}
	}


	public static function required($field, $value)
	{
		if(empty($value)) {
			self::throwError(ucfirst($field) . ' is required', 900);
		}

		return $value;
	}


	public static function nullable($field, $value)
	{
		return $value;
	}


	public static function int($field, $value)
	{
		$value = filter_var($value, FILTER_VALIDATE_INT);
		if($value === false) {
			self::throwError(ucfirst($field) . ' must be integer', 901);
		}

		return trim($value);
	}

	public static function float($field, $value)
	{
		$value = filter_var($value, FILTER_VALIDATE_FLOAT);
		if($value === false) {
			self::throwError(ucfirst($field) . ' must be a float', 901);
		}

		return trim($value);
	}


	public static function string($field, $value)
	{
		if(!is_string($value)) {
			self::throwError(ucfirst($field) . ' must be string', 902);
		}

		return trim(htmlspecialchars($value));
	}


	public static function bool($field, $value)
	{
		$value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
		if($value === false) {
			self::throwError(ucfirst($field) . ' must be bool', 903);
		}

		return $value;
	}


	public static function email($field, $value)
	{
		$value = filter_var($value, FILTER_VALIDATE_EMAIL);
		if($value === false) {
			self::throwError(ucfirst($field) . ' must be a valid email', 904);
		}

		return trim($value);
	}

	public static function url($field, $value)
	{
		$value = filter_var($value, FILTER_VALIDATE_URL);
		if($value === false) {
			self::throwError(ucfirst($field) . ' must be a valid URL', 905);
		}

		return $value;
	}

	public static function tooshort($fieldname, $value, $minimum)
	{
		$length = strlen($value);
		if($length < $minimum) {
			// do error handling
		}
	}

	public static function toolong($fieldname, $value, $maximum)
	{
		$length = strlen($value);
		if($length > $maximum) {
			// do error handling
		}
	}

	public static function badcontent($fieldname, $value)
	{
		if(!preg_match("/^[a-zA-Z0-9 '-]*$/", $value)) {
			// do error handling
		}
	}

	public static function throwError($error = 'Error In Processing', $errorCode = 0)
	{
		if(self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}
}