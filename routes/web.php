<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'showloginform'])->name('login.show');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::middleware(['auth'])->group(function(){
Route::get('dashbord',[AuthController::class,'index'])->name('dashbord');
Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::resource('trips',TripController::class);
Route::resource('activities',ActivityController::class);
Route::resource('bookings',BookingController::class);
Route::get('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::resource('hotels',HotelController::class);
Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.change-password');
Route::post('/admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.update-password');
});