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
        'ol_work_key'
    ];

    public function authors() {
        return $this->belongsToMany(Author::class);
    }

    public function editions() {
        return $this->hasMany(Edition::class);
    }
}
