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
        'recentBooks' => App\Book::take(12)->latest()->with('authors')->get()
    ]);
});

// GET /books -- @index
// GET /books/create -- @create
// GET /books/:isbn/edit -- @edit
// POST /books -- @store
// PUT /books/:isbn -- @update
// DELETE /books/:isbn -- @destroy

// Books
Route::get('/books', 'BooksController@index')->name('books.index');
Route::get('/books/create', 'BooksController@create')->name('books.create');
Route::post('/books', 'BooksController@store')->name('books.store');
Route::get('/books/{id}', 'BooksController@show')->name('books.show');

//Route::get('/books/{$id}/edit', 'BooksController@edit');
//Route::put('/books/{$id}', 'BooksController@update');

// Authors
Route::get('/authors', 'AuthorsController@index')->name('authors.index');
Route::get('/authors/create', 'AuthorsController@create')->name('authors.create');
Route::post('/authors', 'AuthorsController@store')->name('authors.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
