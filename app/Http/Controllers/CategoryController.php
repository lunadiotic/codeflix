<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        $categories = DB::table('categories')->select(['id', 'name', 'slug'])->get();
        $categories = DB::table('categories')->whereLike('name', '%a%')->get();
        $categories = DB::table('categories')->where('id', 1)->first();

        $categories = Category::all();
        $categories = Category::select(['id', 'name', 'slug'])->get();
        $categories = Category::whereLike('name', '%a%')->get();
        $categories = Category::where('id', 1)->first();
        $categories = Category::find(1);

        return $categories;
    }
}