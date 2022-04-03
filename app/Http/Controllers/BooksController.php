<?php

namespace App\Http\Controllers;

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

        $validated = $request->validated();

        // Order:
        // publisher (belongs to many editions)
        // book (has many editions, has many authors)
        // edition (has one publisher, has one book)
        // author (has many books)

        // Publisher
        $publisherRequest = $validated['publisher'];
        $publisher = Publisher::firstOrCreate([ // find first result or create new
            'name' => $publisherRequest["name"]
        ]);

        // Book
        $bookRequest = $validated['book'];
        $book = Book::firstOrCreate([
            'title'      => $bookRequest["title"],
            'blurb'      => $bookRequest["blurb"],
            'cover'      => $bookRequest["cover"],
            'url'        => $bookRequest["url"],
        ]);

        // Edition
        $editionRequest = $validated['edition'];
        Edition::firstOrCreate([
            'isbn10'       => $editionRequest["isbn_10"],
            'isbn13'       => $editionRequest["isbn_13"],
            'publisher_id' => $publisher->id,
            'book_id'      => $book->id,
            'goodreads'    => $editionRequest["goodreads"],
            'openlibrary'  => $editionRequest["openlibrary"],
            'publish_date' => $editionRequest["publish_date"],
            // TODO refactor to mutator https://laravel.com/docs/6.x/eloquent-mutators#defining-a-mutator
            'format'       => EditionFormat::coerce(ucfirst($editionRequest['format'])),
            'pages'        => $editionRequest["pages"]
        ]);



        // Author(s)
        $authors = $validated['authors'];
        foreach($authors as $author) {
            $auth = Author::firstOrCreate([
                'first_name'    => $author['first_name'],
                'last_name'     => $author['last_name'],
                //'pseudonym'     => $author['pseudonym'], // TODO get pseudonym
                'birth_date'    => $author['birth_date'],
                'death_date'    => $author['death_date'],
                'ol_author_key' => $author['ol_author_key'],
            ]);
            // Only attach the author to the book if this relationship is not yet established
            $existingAuthorBookRelationship = $book->authors()->where('author_id', $auth->id)->first();
            if(is_null($existingAuthorBookRelationship)) {
                $book->authors()->attach($auth);
            }
        }

        return $book;
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
