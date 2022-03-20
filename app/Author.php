<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'pseudonym',
        'birth_date',
        'death_date',
        'ol_author_key',
    ];

    public function books() {
        return $this->belongsToMany(Book::class);
    }
}
