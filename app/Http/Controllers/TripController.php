<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Trip;
use App\Models\Type;
use Illuminate\Http\Request;

class TripController extends Controller
{
    
    public function index()
    {
    $trips = Trip::all();
    return view('trips.index', compact('trips'));
    }
    
    public function create()
    {
        $hotels = Hotel::all();
        $triptype= Type::all();
        return view('trips.create', compact('hotels','triptype'));
    }

    
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'type_id' => 'required|exists:types,id',
        'hotel_id' => 'required|exists:hotels,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'price' => 'required|numeric|min:0',
        'available_seats' => 'required|integer|min:1',
    ]);

    $images = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName(); 
            $image->move(public_path('images/trips'), $imageName);
            $images[] = $imageName;
        }
    }

    $validatedData['image'] = json_encode($images);

    Trip::create($validatedData);

    return redirect()->route('trips.index');
}
    
    public function show(Trip $trip)
    {
    $reviews = $trip->reviews;
    $bookings = $trip->bookings;

    return view('trips.show', compact('trip', 'reviews', 'bookings'));
}

    
    public function edit(Trip $trip)
    {
        $hotels = Hotel::all();
        $triptype= Type::all();
        return view('trips.edit', compact('trip','hotels','triptype'));
    }

public function update(Request $request, Trip $trip)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'type_id' => 'required|exists:types,id',
        'hotel_id' => 'required|exists:hotels,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'price' => 'required|numeric|min:0',
        'available_seats' => 'required|integer|min:1',
    ]);
    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/trips'), $imageName);
            $images[] = $imageName;
        }
        $validatedData['image'] = json_encode($images);
    } else {
        $validatedData['image'] = $trip->image;
    }
    $trip->update($validatedData);
    return redirect()->route('trips.index');
}
    public function destroy(Trip $trip)
    {
        $trip->delete();
    return redirect()->route('trips.index');
    }
}
