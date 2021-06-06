<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author() {
        return $this->belongsToMany(Author::class);
    }

    public function edition() {
        return $this->hasMany(Edition::class);
    }
}
