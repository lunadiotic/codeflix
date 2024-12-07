<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $movie = Movie::find(1)->with('ratings')->first();
        $ratings = $movie->ratings()->get();

        return $movie;
    }

    public function store()
    {
        $movie = Movie::find(1);
        $movie->ratings()->create([
            'user_id' => 2,
            'rating' => 5,
        ]);

        return 'Rating created successfully!';
    }
}
