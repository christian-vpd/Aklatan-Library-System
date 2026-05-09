<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Fiction',
                'description' => 'Imaginative literary works',
            ],
            [
                'name' => 'Non-Fiction',
                'description' => 'Based on real events and facts',
            ],
            [
                'name' => 'Science',
                'description' => 'Books about scientific topics and discoveries',
            ],
            [
                'name' => 'History',
                'description' => 'Historical events and analysis',
            ],
            [
                'name' => 'Technology',
                'description' => 'Computers, IT, and modern innovations',
            ],
        ]);
    }
}