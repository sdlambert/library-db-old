<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    public function publisher() {
        // an edition has one publisher
        // a publisher belongs to many editions
        return $this->hasOne(Publisher::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
