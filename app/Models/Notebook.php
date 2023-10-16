<?php 

namespace App\Models;

class Notebook extends Model
{
	protected $table = "notebooks";

	protected $fillable = [
		'manufacturer',
		'type',
		'display',
		'memory',
		'harddisk',
		'videocontroller',
		'price',
		'processor_id',
		'opsystem_id',
		'pieces'
	];

	public function __construct() {
		parent::__construct();
	}
}