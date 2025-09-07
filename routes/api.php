<?php

use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\TripController;
use App\Http\Controllers\api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/types',[TypeController::class,'index']);
Route::get('/types/{type}',[TypeController::class,'show']);
Route::get('/trips/{trip}',[TripController::class,'show']);
Route::post('/bookings/create',[BookingController::class,'store']);
Route::get('/hotels',[HotelController::class,'index']);