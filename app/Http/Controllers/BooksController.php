<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Edition;
use App\Publisher;
use App\Book;
use App\Enums\EditionFormat;
use BenSampo\Enum\Rules\EnumValue;

class BooksController extends Controller
{
    // Render a list of all books
    public function index() {
        $books = Book::latest()->get();

        return view('books.index', ['books' => $books]);
    }

    // Show a single book
    public function show($isbn) {
        $book = Book::where('isbn', $isbn)->firstOrFail();

        return view('book', [
            'books.show' => $book
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

    // Persists the book in the database
    public function store() {

        request()->validate([
            // publishers
            'publisher.name'       => 'required|string',
            // edition
            'edition.isbn10'       => 'required_without:isbn13|nullable|string', // must allow nullable
            'edition.isbn13'       => 'required_without:isbn10|nullable|string', // must allow nullable
            'edition.goodreads'    => 'nullable|string',
            'edition.openlibrary'  => 'nullable|string',
            'edition.publish_date' => 'nullable|string',
            'edition.format'       => 'nullable|string',
            'edition.pages'        => 'nullable|integer',
            // book
             'title'               => 'required|string',
             'blurb'               => 'nullable|string',
             'url'                 => 'nullable|url',
             'cover'               => 'nullable|url',

        ]);

        // Publishers (array)
        $publisher = request('publisher');

        $pub = Publisher::firstOrNew([
            'name' => $publisher["name"]
        ]);

        if(!$pub->exists) {
            $pub->save();
        }

        // Edition
        $edition = new Edition();

        $edition->publisher_id = $pub->id;
        $edition->isbn10       = request('edition.isbn10');
        $edition->isbn13       = request('edition.isbn13');
        $edition->goodreads    = request('edition.goodreads');
        $edition->openlibrary  = request('edition.openlibrary');
        $edition->publish_date = request('edition.publish_date');
        $edition->format       = EditionFormat::coerce(request('edition.format'));
        $edition->pages        = request('edition.pages');

        $edition->save();

        // Author(s)
        $authors = request('authors');
        foreach($authors as $author) {
            $auth = Publisher::firstOrNew([
                'name' => $publisher["name"]
            ]);
        }

        // Book
        // title
        // authors



        // old validation
        // request()->validate([
        //     'title'      => 'required|string',
        //     'blurb'      => 'nullable|string',
        //     'author_id'  => 'nullable|integer',
        //     'first_name' => 'required|string',
        //     'last_name'  => 'required|string',
        //     'pseudonym'  => 'nullable|string',
        //     'birth_date' => 'nullable|date|before:today',
        //     'death_date' => 'nullable|date|before:today',
        //     'isbn13'     => 'required_without:isbn10|nullable|integer', // must allow nullable
        //     'isbn10'     => 'required_without:isbn13|nullable|integer', // must allow nullable
        //     'publisher'  => 'nullable|string',
        //     'month'      => 'nullable|integer',
        //     'year'       => 'nullable|integer',
        //     'pages'      => 'nullable|integer',
        //     'format'     => ['nullable', new EnumValue(EditionFormat::class, false)],
        //     'goodreads'  => 'nullable|integer',
        // ]);


        if(is_null(request('author_id'))) {
            // Persist author

        }

        // Book
//        $book = new Book();
//        $book->title = request('title');
//        $book->blurb = request('blurb');
//        $book->author_id = 0; // todo remove
//        $book->edition_id = 0; // todo remove
//        $book->save();
//
//        return redirect('books.show', $book);


        // Author
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
