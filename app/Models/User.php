<?php

namespace App\Models;

use PDO;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	public function __construct() {
		parent::__construct();
	}
}