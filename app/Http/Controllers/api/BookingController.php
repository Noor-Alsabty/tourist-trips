<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request){

$request->validate([
        'trip_id' => 'required',
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email',
        'number_of_people' => 'required|integer|min:1',
        'credit_card_number' => 'required|string',
    ]);

    // تحقق من توفر المقاعد
    $trip = Trip::find($request->trip_id);
    if ($trip->available_seats < $request->number_of_people) {
        return response()->json(['message' => ' Not enough seats.'], 400);
    }

    // إنشاء الحجز
    $booking = Booking::create([
        'trip_id' => $trip->id,
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'number_of_people' => $request->number_of_people,
        'status' => 'confirmed',
    ]);
$total_price = $trip->price * $request->number_of_people;
    // إنشاء الدفع
    $payment = Payment::create([
        'booking_id' => $booking->id,
        'credit_card_number' => $request->credit_card_number,
        'total_price' => $total_price,
    ]);

    // تحديث عدد المقاعد المتاحة
    $trip->available_seats -= $request->number_of_people;
    $trip->save();

    return response()->json([
        'message' => 'Reservation Successful',
        'booking' => $booking,
        'payment' => $payment
    ], 201);
    }
}
