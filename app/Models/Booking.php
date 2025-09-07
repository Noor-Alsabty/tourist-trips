<?php

namespace App\Models;
// use App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    public $timestamps = true;

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    protected $fillable = [
        'trip_id',
        'customer_name',
        'customer_email',
        'number_of_people',
        'status',
    ];
}
