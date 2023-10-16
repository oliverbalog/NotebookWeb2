<?php 

namespace App\Models;

class Processor extends Model
{
	protected $table = "processors";

	protected $fillable = [
        'manufacturer',
		'type'
	];

	public function __construct() {
		parent::__construct();
	}
}