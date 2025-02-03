<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class MovieController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            'check.device.limit'
        ];
    }

    public function index()
    {
        $latestMovies = Movie::latest()->limit(8)->get();
        $popularMovies = Movie::with('ratings')
            ->get()
            ->sortByDesc('average_rating')
            ->take(8);

        return view('movies.index', [
            'latestMovies' => $latestMovies,
            'popularMovies' => $popularMovies,
        ]);
    }
}
