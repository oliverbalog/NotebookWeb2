<?php

namespace App\Models;

class News extends Model
{
  protected $table = "news";
  protected $fillable = [
    'title',
    'content',
    'created_at',
    'created_by'
  ];

  public function __construct()
  {
    parent::__construct();
  }
}