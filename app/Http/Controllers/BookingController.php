<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
{
    $query = Booking::query();

    if ($request->filled('trip_id')) {
        $query->where('trip_id', $request->trip_id);
    }

    $bookings = $query->with('trip')->get();
    $trips = Trip::all();

    return view('bookings.index', compact('bookings', 'trips'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trip=Trip::all();
        $payment=payment::all();
        return view('bookings.create',compact('trip','payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'number_of_people' => 'required|integer|min:1',
            'credit_card_number' => 'required|digits:16',
        ]);

        $trip = Trip::findOrFail($request->trip_id);


        if ($request->number_of_people > $trip->available_seats) {
            return redirect()->back()->with('error', 'عدد الأشخاص أكبر من عدد المقاعد المتاحة!');
        }


        $totalPrice = $trip->price * $request->number_of_people;

        $booking = Booking::create([
            'trip_id' => $trip->id,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'number_of_people' => $request->number_of_people,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
        ]);
        Payment::create([
        'booking_id' => $booking->id,
        'credit_card_number' => $request->credit_card_number,
        'total_price' => $totalPrice,
    ]);


        $trip->available_seats -= $request->number_of_people;
        $trip->save();
        return redirect()->route('bookings.index');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }
public function confirm($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status !== 'confirmed') {
        $trip = $booking->trip;


        if ($booking->number_of_people <= $trip->available_seats) {
            $trip->available_seats -= $booking->number_of_people;
            $trip->save();

            $booking->status = 'confirmed';
            $booking->save();
        } else {
            return redirect()->back()->with('error', 'لا يوجد عدد كافٍ من المقاعد لتأكيد الحجز');
        }
    }

    return redirect()->route('bookings.index')->with('success', 'تم تأكيد الحجز');
}


public function cancel($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status !== 'cancelled') {
        $trip = $booking->trip;
        $trip->available_seats += $booking->number_of_people;
        $trip->save();

        $booking->status = 'cancelled';
        $booking->save();
    }

    return redirect()->route('bookings.index')->with('success', 'تم إلغاء الحجز');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
    $trip = Trip::all();
    $booking->load('payment');
    return view('bookings.edit', compact('booking', 'trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
    $request->validate([
        'trip_id' => 'required|exists:trips,id',
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'nullable|email',
        'number_of_people' => 'required|integer|min:1',
        'credit_card_number' => 'required|string|digits:16',
        'total_price' => 'required|numeric|min:0',
    ]);

    $booking->update($request->all());

    return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Booking $booking)
{
    $trip = $booking->trip;

    if ($booking->status === 'confirmed') {
        $trip->available_seats += $booking->number_of_people;
        $trip->save();
    }

    if ($booking->payment) {
        $booking->payment->delete();
    }

    $booking->delete();

    return redirect()->route('bookings.index');
}

    }

