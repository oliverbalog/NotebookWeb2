<?php 

namespace App\Models;

class Opsystem extends Model
{
	protected $table = "opsystems";

	protected $fillable = [
		'os_name'
	];

	public function __construct() {
		parent::__construct();
	}
}