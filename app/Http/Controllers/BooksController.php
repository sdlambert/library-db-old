<?php

namespace App\Http\Controllers;

use App\Actions\StoreNewBookAction;
use App\Http\Requests\StoreNewBook;
use App\Author;
use App\Edition;
use App\Publisher;
use App\Book;
use App\Enums\EditionFormat;

class BooksController extends Controller
{
    // Render a list of all books
    public function index() {
        $books = Book::latest()->get();

        return view('books.index', ['books' => $books]);
    }


    // Show a single book
    public function show ($id) {
        $book = Book::with(['authors', 'editions.publisher'])->find($id);

        return view('books.show', [
            'book' => $book,
        ]);
    }

    // Shows a view to create a new book
    public function create() {
        // get all publishers
        $publishers = Publisher::all();

        return view('books.create', [
            'publishers' => $publishers,
            'editionFormat' => EditionFormat::toSelectArray(),
        ]);
    }

    /** Persists the book in the database
     * @param StoreNewBook $request
     * @return Book|\Illuminate\Database\Eloquent\Model
     */
    public function store(StoreNewBook $request) {
        $storeNewBookAction = new StoreNewBookAction;
        return $storeNewBookAction->execute($request->validated());
    }

    // Show a view to edit an existing book
    public function edit($id) {
        $book = Book::find($id);
        $edition = Edition::find($book->edition_id);
        $publisher = Publisher::find($edition->publisher_id);
        $author = Author::find($book->author_id);

        return view('books.edit', [
            'book'    => $book,
            'edition' => $edition,
            'publisher' => $publisher,
            'author'  => $author,
        ]);
    }

    // Persist the edited book
    public function update($id) {
        $book = Book::find($id);
        //$edition = Edition::find($book->edition_id);
        //$author = Author::find($book->author_id);

        // do things

        $book->saveOrFail();


        return redirect('book.show', $book);

    }

    // Destroy a book
    public function destroy() {

    }
}
