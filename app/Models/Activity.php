<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    public $timestamps = true;

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    protected $fillable=[
        'trip_id',
        'name',
        'description',
        'start_time',
        'end_time',
        
    ];
}
