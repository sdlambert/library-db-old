<?php

namespace App\Actions;

use App\Author;
use App\Book;
use App\Edition;
use App\Publisher;

class StoreNewBookAction
{
    public function execute(Array $validated) {

        // publisher (belongs to many editions)
        // book (has many editions, has many authors)
        // author (has many books)
        // edition (has one publisher, has one book)

        $publisher = $this->addPublisher($validated["publisher"]);
        $book = $this->addBook($validated["book"]);
        $this->addAuthors($validated["authors"], $book);
        $this->addEdition($validated["edition"], $book, $publisher);

        return $book;
    }

    private function addPublisher(Array $publisher) {
        return Publisher::firstOrCreate([ // find first result or create new
            'name' => $publisher["name"]
        ]);
    }

    private function addBook(Array $book) {
        return Book::firstOrCreate([
            'title'      => $book["title"],
            'blurb'      => $book["blurb"],
            'cover'      => $book["cover"],
            'url'        => $book["url"],
        ]);
    }

    private function addEdition(Array $edition, Book $book, Publisher $publisher): void
    {
        Edition::firstOrCreate([
            'isbn10'       => $edition["isbn_10"],
            'isbn13'       => $edition["isbn_13"],
            'publisher_id' => $publisher->id,
            'book_id'      => $book->id,
            'goodreads'    => $edition["goodreads"],
            'openlibrary'  => $edition["openlibrary"],
            'publish_date' => $edition["publish_date"],
            'format'       => $edition['format'],
            'pages'        => $edition["pages"]
        ]);
    }

    private function addAuthors(Array $authors, Book $book) {
        foreach($authors as $author) {
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