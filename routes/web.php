<?php

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
    return view('welcome', [
        'recentBooks' => App\Book::take(3)->latest()->get()
    ]);
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/books/isbn/{$isbn}', 'BooksController@show');
