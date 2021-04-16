<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/bus_reservation', function () {
//     return view('reservations/index');
// })->name('bus_reservation');
// Route::middleware(['auth:sanctum', 'verified'])->get('/booking/create', function () {
//     return view('booking/create');
// })->name('booking');



Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/booking/create', [BookingsController::class,'create'])->name('booking');    
    Route::post('/booking/store', [BookingsController::class,'store'])->name('store');
    Route::get('/bus_reservation', [BookingsController::class,'index'])->name('bus_reservation');    
    Route::get('/available_seats', [BookingsController::class,'available_seats'])->name('available_seats');    
    
    Route::post('/check_available_seats', [BookingsController::class,'check_available_seats'])->name('check_available_seats');


});

