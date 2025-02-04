<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

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

    public function all(Request $request)
    {
        $movies = Movie::orderBy('release_date', 'desc')->paginate(8);
        if ($request->ajax()) {
            $html = view('components.movie-list', compact('movies'))->render();
            return response()->json([
                'html' => $html,
                'next_page' => $movies->nextPageUrl()  // Mengirim URL halaman berikutnya
            ]);
        }
        return view('movies.all', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $userPlan = Auth::user()->getCurrentPlan();
        $streamingUrl = $movie->getStreamingUrl($userPlan->resolution);
        return view('movies.show', [
            'movie' => $movie,
            'streamingUrl' => $streamingUrl
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('q');
        $movies = Movie::where('title', 'like', "%$search%")->get();
        return view('movies.search', [
            'keyword' => $search,
            'movies' => $movies
        ]);
    }
}
