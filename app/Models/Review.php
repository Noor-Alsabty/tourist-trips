<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
protected $table = 'reviews';
    public $timestamps = true;
protected $fillable = [
    'trip_id',
    'comment',
    'rating',
    'review_date',
];



    public function tripes()
    {
        return $this->belongsTo(Trip::class);
    }
}