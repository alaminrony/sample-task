<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SeatLockController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Start api for events
    Route::controller(EventController::class)->prefix('events')->group(function () {
        Route::get('/list',                         'index')->name('event.index');
        Route::get('/details/list',                 'details')->name('event.details.list');
    });
    // End api for events

    Route::controller(SeatLockController::class)->prefix('seat-lock')->group(function () {
        Route::post('/',                     'lockSeat');
    });

    Route::controller(BookingController::class)->prefix('book-ticket')->group(function () {
        Route::post('/',                     'bookTicket');
    });

});
