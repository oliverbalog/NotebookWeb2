<?php

namespace App\Helpers;

use ReflectionClass;

class ReflectionResolver
{
	public static function resolve(string $class): object
	{
		$reflectionClass = new ReflectionClass($class);

		if (($constructor = $reflectionClass->getConstructor()) === null) {
			return $reflectionClass->newInstance();
		}

		if (($params = $constructor->getParameters()) === []) {
			return $reflectionClass->newInstance();
		}

		$newInstanceParams = [];

		foreach ($params as $param) {
			$newInstanceParams[] = $param->getType() === null
				? $param->getDefaultValue()
				: self::resolve($param->getType()->getName()); 
		}

		return $reflectionClass->newInstanceArgs(
			$newInstanceParams
		);
	}
}