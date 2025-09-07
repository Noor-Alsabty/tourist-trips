<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trips';
    public $timestamps = true;

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function bookings()
    {
        return $this->hasMany('Booking');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function types()
    {
        return $this->belongsTo('Type');
    }
    protected $fillable = [
        'name',
        'description',
        'image',
        'start_date',
        'end_date',
        'price',
        'available_seats',
        'type_id',
        'hotel_id'
    ];
    protected $casts = [
        'images[]' => 'array',
    ];
}