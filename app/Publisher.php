<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function editions() {
        // an edition has one publisher
        // a publisher belongs to many editions
        return $this->belongsToMany(Edition::class);
    }
}
