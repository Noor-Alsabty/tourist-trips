<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    
    }

    public function create()
        {
        return view('hotels.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'rating' => 'required|in:1,2,3,4,5',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imageNames = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/hotels'), $imageName);
            $imageNames[] = $imageName;
        }
    }

    Hotel::create([
        'name' => $request->name,
        'rating' => $request->rating,
        'image' => json_encode($imageNames),
    ]);

    return redirect()->route('hotels.index')->with('success', 'تم حفظ الفندق مع الصور');
}

public function show(Hotel $hotel)
{
    return view('hotels.show', compact('hotel'));
}


    public function edit(Hotel $hotel)
{
    return view('hotels.edit', compact('hotel'));
}

public function update(Request $request, Hotel $hotel)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'rating' => 'required|in:1,2,3,4,5',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $hotel->name = $request->name;
    $hotel->rating = $request->rating;

    $newImages = [];

    // إذا تم رفع صور جديدة
    if ($request->hasFile('images')) {

        // حذف الصور القديمة من المجلد
        if ($hotel->image) {
            foreach (json_decode($hotel->image) as $oldImage) {
                $oldPath = public_path('images/hotels/' . $oldImage);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        // رفع الصور الجديدة وتخزينها
        foreach ($request->file('images') as $image) {
            $imageName = time() . '-' . uniqid() . '.' .  $image->getClientOriginalName();
            $image->move(public_path('images/hotels'), $imageName);
            $newImages[] = $imageName;
        }

        // تخزين الصور الجديدة داخل عمود image بصيغة JSON
        $hotel->image = json_encode($newImages);
    }

    $hotel->save();

    return redirect()->route('hotels.index')->with('success', 'تم تحديث بيانات الفندق والصور بنجاح');
}


public function destroy(Hotel $hotel)
{
        $hotel->delete();
    return redirect()->route('hotels.index');
}

}
