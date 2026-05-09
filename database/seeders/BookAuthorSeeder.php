<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookAuthorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('book_authors')->insert([
            [
                'book_id' => 1,
                'author_id' => 2,
            ],
            [
                'book_id' => 2,
                'author_id' => 1,
            ],
            [
                'book_id' => 3,
                'author_id' => 5,
            ],
        ]);
    }
}