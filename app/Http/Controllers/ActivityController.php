<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Trip;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $trip=Trip::all();
        $activity= Activity::all();
        return view('activities.index',compact('activity','trip'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trip=Trip::all();
        return view('activities.create',compact('trip'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$request->validate([
        'trip_id' => 'required|exists:trips,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required',
        'end_time' => 'required',
    ]);

    Activity::create([
        'trip_id' => $request->trip_id,
        'name' => $request->name,
        'description' => $request->description,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);
return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Activity $activity)
{
    $trip = Trip::all();
    return view('activities.edit', compact('activity', 'trip'));
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
    $validated = $request->validate([
        'trip_id'     => 'required|exists:trips,id',
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time'  => 'required|after_or_equal:today',
        'end_time'    => 'required|after:start_date',
    ]);
    $activity->update($validated);
    return redirect()->route('activities.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
    return redirect()->route('activities.index');
    }
}
