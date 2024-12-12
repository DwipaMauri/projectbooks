<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/getbooks/author_id', [BookController::class, 'index'])->name('books.index');

// for author page of top ten authors
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

// for rating page and post rating
Route::get('/ratings', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/', function () {
    return view('welcome');
});
