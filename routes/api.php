<?php

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\Books as BooksResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', 'API\BooksController@index')->name('api.books.index');

Route::get('/books/latest', function (Request $request) {
    if($request->has('count')) {
        $count = $request->count;
    } else $count = 12;

    return new BooksResource(Book::take($count)->latest()->with('authors')->get());
});
Route::get('/books/{id}', 'API\BooksController@show')->name('api.books.show');
