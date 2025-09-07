<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{

public function show($id)
{
    $trip = Trip::find($id);

    if (!$trip) {
        return response()->json(['message' => 'trip not found.'], 404);
    }
    $trip->load(['activities', 'hotel']);

    if ($trip->activities->isEmpty()) {
        return response()->json(['message' => 'No activities found for this trip.'], 404);
    }

    $transtrip = [
        'id' => $trip->id,
        'name' => $trip->name,
        'description' => $trip->description,
        'image' => $trip->image,
        'start_date' => $trip->start_date,
        'end_date' => $trip->end_date,
        'price' => $trip->price,
        'available_seats' => $trip->available_seats,
        'created_at' => $trip->created_at,
        'updated_at' => $trip->updated_at,

        'hotel' => $trip->hotel ? [
            'id' => $trip->hotel->id,
            'name' => $trip->hotel->name,
            'image' => $trip->hotel->image,
            'rating' => $trip->hotel->rating,
        ] : null,

        'activities' => $trip->activities->map(function ($activity) {
            return [
                'id' => $activity->id,
                'name' => $activity->name,
                'description' => $activity->description,
                'start_time' => $activity->start_time,
                'end_time' => $activity->end_time,
            ];
        }),
    ];

    return response()->json(['trip' => $transtrip]);
}



}
