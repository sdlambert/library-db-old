<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'blurb',
        'cover',
        'url',
        'edition_id'
    ];

    public function authors() {
        return $this->belongsToMany(Author::class);
    }

    public function edition() {
        return $this->hasMany(Edition::class);
    }
}
