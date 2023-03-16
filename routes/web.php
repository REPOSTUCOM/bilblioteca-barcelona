<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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
use App\Http\Controllers\BookController;
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class,'store'])->name('books.store');
Route::get('/books/{id?}', [BookController::class, 'show']);
Route::get('/books/{id?}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id?}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id?}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/success', function () {return view('books.success');})->name('success');