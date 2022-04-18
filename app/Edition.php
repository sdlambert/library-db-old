<?php

namespace App;

use App\Enums\EditionFormat;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'isbn10',
        'isbn13',
        'publisher_id',
        'book_id',
        'goodreads',
        'ol_edition_key',
        'publish_date',
        'format',
        'pages',
    ];

    protected $appends = [
        'format_description',
    ];

    public function publisher() {
        // an edition has one publisher
        // a publisher belongs to many editions
        return $this->belongsTo(Publisher::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    /**
     * Returns the description of the EditionFormat value (i.e. "Hardcover")
     * @return string
     */
    public function getFormatDescriptionAttribute(): string
    {
        $value = (int)$this->attributes['format'];
        return EditionFormat::getDescription($value);
    }

    /**
     * Coerces a string into an edition format
     * @param $formatString
     * @return void
     */
    public function setFormatAttribute($formatString) {
        $this->format = EditionFormat::coerce(ucfirst($formatString));
    }
}
