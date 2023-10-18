<?php

namespace App\Models;
use App\Models\Model;

class Rating extends Model
{
    protected $table = "news_rating";
    protected $fillable = [
        'rating',
        'text_rate',
        'rated_by',
        'news_id'
    ];

    public function __construct()
    {
        parent::__construct();
    }

}