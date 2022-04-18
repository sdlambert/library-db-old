<?php

namespace App\Actions;

use App\Author;
use App\Book;
use App\Edition;
use App\Publisher;

class StoreNewBookAction
{
    private $isNewPublisher = false;
    private $isNewBook = false;
    private $isNewAuthor = false;
    private $newAuthorCount = 0;
    private $isNewEdition = false;

    /**
     * Creates the records to store a new book (volume) into the database
     *
     * @param array $validated
     * @return array
     */
    public function execute(Array $validated) {

        // publisher (belongs to many editions)
        // book (has many editions, has many authors)
        // author (has many books)
        // edition (has one publisher, has one book)

        $publisher = $this->addPublisher($validated["publisher"]);
        $book = $this->addBook($validated["book"]);
        $this->addAuthors($validated["authors"], $book);
        $this->addEdition($validated["edition"], $book, $publisher);

        return [
            "book"           => $book,
            "isNewPublisher" => $this->isNewPublisher,
            "isNewAuthor"    => $this->isNewAuthor,
            "isNewEdition"   => $this->isNewEdition,
            "isNewBook"      => $this->isNewBook
        ];
    }

    /**
     * Determines if an author already exists in the table
     *
     * @param $authorKey
     * @return bool
     */
    private function authorExists($authorKey): bool
    {
        return Author::where('ol_author_key', $authorKey)->exists();
    }

    /**
     * Determines if an edition already exists in the table`
     *
     * @param $ol_edition_key
     * @return bool
     */
    private function editionExists($ol_edition_key): bool
    {
        return !Edition::where('ol_edition_key', $ol_edition_key)->exists();
    }

    /**
     * Determines if a book already exists in the table
     *
     * @param $title
     * @return bool
     */
    private function bookExists($title): bool
    {
        return !Book::where('title', $title)->exists();
    }

    /**
     * @param $name
     * @return bool
     */
    private function publisherExists($name): bool
    {
        return Publisher::where('name', $name)->exists();
    }

    /**
     * Adds a new publisher or retrieves the existing publisher model
     *
     * @param array $publisher
     * @return Publisher|\Illuminate\Database\Eloquent\Model
     */
    private function addPublisher(Array $publisher) {
        if(!$this->publisherExists($publisher["name"])) {
            $this->isNewPublisher = true;
        }

        return Publisher::firstOrCreate([ // find first result or create new
            'name' => $publisher["name"]
        ]);
    }

    /**
     * Adds a new book or retrieves the existing book model
     *
     * @param array $book
     * @return Book|\Illuminate\Database\Eloquent\Model
     */
    private function addBook(Array $book) {
        if($this->bookExists($book["ol_work_key"])) {
            $this->isNewBook = true;
        }

        return Book::firstOrCreate([
            'title'       => $book["title"],
            'blurb'       => $book["blurb"],
            'cover'       => $book["cover"],
            'url'         => $book["url"],
            'ol_work_key' => $book["ol_work_key"]
        ]);
    }

    /**
     * Adds a new edition or retrieves the existing edition model
     *
     * @param array     $edition
     * @param Book      $book
     * @param Publisher $publisher
     * @return void
     */
    private function addEdition(Array $edition, Book $book, Publisher $publisher): void
    {
        if($this->editionExists($edition["ol_edition_key"])) {
            $this->isNewEdition = true;
        }

        Edition::firstOrCreate([
            'ol_edition_key'  => $edition["ol_edition_key"],
        ],[
            'isbn10'          => $edition["isbn_10"],
            'isbn13'          => $edition["isbn_13"],
            'publisher_id'    => $publisher->id,
            'book_id'         => $book->id,
            'goodreads'       => $edition["goodreads"],
            'ol_edition_key'  => $edition["ol_edition_key"],
            'publish_date'    => $edition["publish_date"],
            'format'          => $edition['format'],
            'pages'           => $edition["pages"]
        ]);
    }

    /**
     * Adds a new author or retrieves the existing edition model and creates
     * a relationship between the book and the author if it doesn't exist
     *
     * @param array $authors
     * @param Book  $book
     * @return void
     */
    private function addAuthors(Array $authors, Book $book) {
        foreach($authors as $author) {
            if(!$this->authorExists($author['ol_author_key'])) {
                $this->isNewAuthor = true;
                $this->newAuthorCount++;
            }

            $theAuthor = Author::firstOrCreate([
                'first_name'    => $author['first_name'],
                'last_name'     => $author['last_name'],
                //'pseudonym'     => $author['pseudonym'], // TODO get pseudonym
                'birth_date'    => $author['birth_date'],
                'death_date'    => $author['death_date'],
                'ol_author_key' => $author['ol_author_key'],
            ]);

            // Only attach the author to the book if this relationship is not yet established
            $existingAuthorBookRelationship = $book->authors()->where('author_id', $theAuthor->id)->first();
            if(is_null($existingAuthorBookRelationship)) {
                $book->authors()->attach($theAuthor);
            }
        }
    }

}
