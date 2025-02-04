<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CategoryController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
            'check.device.limit'
        ];
    }

    public function show(Category $category)
    {
        $movies = $category->movies()->latest()->get();
        return view('categories.show', [
            'category' => $category,
            'movies' => $movies
        ]);
    }
}
