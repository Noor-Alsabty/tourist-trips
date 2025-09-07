<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Payment extends Model
{
    protected $table = 'payments';
    public $timestamps = true;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    protected $fillable = [
    'booking_id',
    'credit_card_number',
    'total_price',
    ];
}
