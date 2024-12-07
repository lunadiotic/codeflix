<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['title', 'slug'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'category_movie', 'category_id', 'movie_id');
    }
}
