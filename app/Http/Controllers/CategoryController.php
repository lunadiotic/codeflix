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

    public function store()
    {
        DB::table('categories')->insert([
            'title' => 'Action',
            'slug' => 'action',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            ['title' => 'Drama', 'slug' => 'drama', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Horror', 'slug' => 'horror', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Comedy', 'slug' => 'comedy', 'created_at' => now(), 'updated_at' => now()],
        ]);


        $category = new Category();
        $category->name = 'Action';
        $category->slug = 'action';
        $category->save();

        Category::create([
            'title' => 'Fantasy',
            'slug' => 'fantasy',
        ]);

        Category::insert([
            ['title' => 'Documentary', 'slug' => 'documentary', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Thriller', 'slug' => 'thriller', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Musical', 'slug' => 'musical', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function update()
    {
        DB::table('categories')->where('id', 1)->update([
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'updated_at' => now(),
        ]);

        $category = Category::find(1);
        if ($category) {
            $category->title = 'Updated Title';
            $category->slug = 'updated-title';
            $category->save();
        }

        Category::where('id', 1)->update([
            'title' => 'Updated Title',
            'slug' => 'updated-title',
        ]);
    }

    public function delete()
    {
        DB::table('categories')->where('id', 1)->delete();
        Category::destroy(1);
    }
}