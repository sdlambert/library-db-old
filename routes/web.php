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

// Authors
Route::get('/authors', 'AuthorsController@index')->name('authors.index');
Route::get('/authors/create', 'AuthorsController@create')->name('authors.create');