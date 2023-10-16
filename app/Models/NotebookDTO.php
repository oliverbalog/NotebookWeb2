<?php

namespace App\Models;

class NotebookDTO extends Model {
    protected $table = "notebooks";
    protected $fillable = [
		'manufacturer',
		'type',
		'display',
		'memory',
		'harddisk',
		'videocontroller',
		'price',
		'proc_id',
		'proc_manufacturer',
        'proc_type',
        'os_id',
        'os_name',
		'pieces'
	];

    public function __construct() {
		parent::__construct();
	}
}