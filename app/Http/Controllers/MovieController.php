<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('categories')->get();
        return $movies;
    }

    public function attach()
    {
        $movie = Movie::find(1); // Ambil film dengan ID 1
        $movie->categories()->attach([1, 2]); // Tambahkan kategori dengan ID 1 dan 2

        $category = Category::find(1); // Ambil kategori dengan ID 1
        $category->movies()->attach([1, 2, 3]); // Tambahkan film dengan ID 1, 2, dan 3

        return redirect('/movies');
    }

    public function detach()
    {
        $movie = Movie::find(1); // Ambil film dengan ID 1
        $movie->categories()->detach([1, 2]); // Hapus kategori dengan ID 1 dan 2

        $category = Category::find(1); // Ambil kategori dengan ID 1
        $category->movies()->detach([1, 2, 3]); // Hapus film dengan ID 1, 2, dan 3

        return redirect('/movies');
    }

    public function sync()
    {
        $movie = Movie::find(1); // Ambil film dengan ID 1
        $movie->categories()->sync([1, 2]); // Sincronkan kategori dengan ID 1 dan 2

        $category = Category::find(1); // Ambil kategori dengan ID 1
        $category->movies()->sync([1, 2, 3]); // Sincronkan film dengan ID 1, 2, dan 3

        return redirect('/movies');
    }
}
