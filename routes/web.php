<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'bookCount' => Book::count(),
        'availableCount' => Book::where('is_available', true)->count(),
    ]);
})->name('home');

Route::get('/books/{book}/delete', [BookController::class, 'confirmDelete'])
    ->name('books.confirm-delete');

Route::resource('books', BookController::class);
