<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'slug'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
