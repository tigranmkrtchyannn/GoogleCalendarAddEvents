<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GoogleController::class, 'login']);
Route::get('/callback', [GoogleController::class, 'callback']);

Route::middleware('auth')->group(function () {
    Route::get('/create-event', [GoogleController::class, 'createEvent'])->name('create-event');
    Route::post('/create-event', [GoogleController::class, 'storeEvent'])->name('store_event');
    Route::post('/delete-event', [GoogleController::class, 'deleteEvent'])->name('delete_event');
    Route::get('/event', [GoogleController::class, 'getAllEvents'])->name('event');
});
