<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => '1984',
                'isbn' => '9780451524935',
                'description' => 'Dystopian novel about surveillance and totalitarianism.',
                'publisher' => 'Secker & Warburg',
                'publication_year' => 1949,
                'category_id' => 2,
                'created_by' => 1,
            ],
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'isbn' => '9780439708180',
                'description' => 'A young wizard discovers his magical heritage.',
                'publisher' => 'Bloomsbury',
                'publication_year' => 1997,
                'category_id' => 1,
                'created_by' => 1,
            ],
            [
                'title' => 'A Brief History of Time',
                'isbn' => '9780553380163',
                'description' => 'Explores cosmology and black holes.',
                'publisher' => 'Bantam Books',
                'publication_year' => 1988,
                'category_id' => 3,
                'created_by' => 1,
            ],
        ]);
    }
}