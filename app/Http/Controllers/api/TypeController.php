<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
        public function index()
    {
        $types=Type::all();
        $types=$types->map(function($type){
return[
'id'=>$type->id,
'name'=>$type->name,
'created_at'=>$type->created_at,
'updated_at'=>$type->updated_at,
];
});
if ($types->isEmpty()) {
    return response()->json(['message'=>'No types found.'],404);
}
return response()->json(['types'=>$types]);

    }


    
public function show($id){
$type=Type::find($id);
if (!$type) {
    return response()->json(['message'=>'there is no type for this id'],404);
}
$type->load('trips');
if ($type->trips->isEmpty()) {
    return response()->json(['message'=>'No trips found for this type.'],404);
}
$transtype=[
'id'=>$type->id,
'name'=>$type->name,
'created_at'=>$type->created_at,
'updated_at'=>$type->updated_at,
'trips'=>$type->trips->map(function($trip){
return[
'id'=>$trip->id,
'name'=>$trip->name,
'description'=>$trip->description,
'start_date'=>$trip->start_date,
'end_date'=>$trip->end_date,
'price'=>$trip->price,
'available_seats'=>$trip->available_seats,
'created_at'=>$trip->created_at,
'updated_at'=>$trip->updated_at,
];
})
];
return response()->json(['type'=>$transtype]);
}
}
