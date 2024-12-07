<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar film untuk diisi
        $movies = [
            ['name' => 'Inception', 'slug' => 'inception'],
            ['name' => 'The Matrix', 'slug' => 'the-matrix'],
            ['name' => 'Interstellar', 'slug' => 'interstellar'],
            ['name' => 'Avatar', 'slug' => 'avatar'],
            ['name' => 'The Dark Knight', 'slug' => 'the-dark-knight'],
        ];

        // Batch insert ke tabel movies
        DB::table('movies')->insert(array_map(function ($movie) {
            return array_merge($movie, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $movies));
    }
}
