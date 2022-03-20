<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'isbn10',
        'isbn13',
        'publisher_id',
        'goodreads',
        'openlibrary',
        'publish_date',
        'format',
        'pages',
    ];

    public function publisher() {
        // an edition has one publisher
        // a publisher belongs to many editions
        return $this->belongsTo(Publisher::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
