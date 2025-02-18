<?php

namespace Database\Seeders;

use App\Models\author;
use App\Models\book;
use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ini_set('memory_limit', '2024M');
        $faker = Faker::create();

        // Bulk insert for books
        $authorIds = author::pluck('id')->toArray();
        $categoryIds = category::pluck('id')->toArray();

        $books = [];
        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'author_id' => $authorIds[array_rand($authorIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'title' => $faker->sentence
            ];

            // Insert in chunks to manage memory
            if (count($books) >= 1000) {
                book::insert($books);
                $books = [];
            }
        }
        if (!empty($books)) {
            book::insert($books);
        }
    }
}
