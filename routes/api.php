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

Route::get('/books', function () {
    return new BooksResource(Book::with(['authors', 'editions.publisher'])->paginate(12));
});
