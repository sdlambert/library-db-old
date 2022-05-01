<?php

namespace App\Http\Controllers\API;

use App\Actions\StoreNewBookAction;
use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewBook;
use Illuminate\Http\Request;
use App\Http\Resources\Books as BooksResource;
use App\Http\Resources\Book as BookResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BooksResource
     */
    public function index()
    {
        return new BooksResource(Book::with(['authors', 'editions.publisher'])->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(StoreNewBook $request)
    {
        $storeNewBookAction = new StoreNewBookAction;
        return $storeNewBookAction->execute($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BookResource
     */
    public function show($id)
    {
        return new BookResource(Book::with(['authors', 'editions.publisher'])->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
