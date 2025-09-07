<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(){
    $hotels=Hotel::all();
        $hotels=$hotels->map(function($hotel){
return[
'id'=>$hotel->id,
'name'=>$hotel->name,
'image'=>$hotel->image,
'rating'=>$hotel->rating,
'created_at'=>$hotel->created_at,
'updated_at'=>$hotel->updated_at,
];
});
if ($hotels->isEmpty()) {
    return response()->json(['message'=>'No hotel found.'],404);
}
return response()->json(['hotels'=>$hotels]);

    }
}
