<?php

use App\Http\Controllers\RoomController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'roomCount' => Room::count(),
        'availableCount' => Room::where('is_available', true)->count(),
    ]);
})->name('home');

Route::get('/rooms/{room}/delete', [RoomController::class, 'confirmDelete'])
    ->name('rooms.confirm-delete');

Route::resource('rooms', RoomController::class);
