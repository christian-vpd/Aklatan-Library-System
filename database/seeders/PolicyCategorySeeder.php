<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Borrowing',  'description' => 'Policies related to borrowing and returning of books'],
            ['name' => 'Conduct',    'description' => 'Behavioral and conduct policies inside the library'],
            ['name' => 'Fines',      'description' => 'Policies regarding fines, penalties, and payments'],
            ['name' => 'Membership', 'description' => 'Policies regarding patron registration and library access'],
            ['name' => 'General',    'description' => 'General library rules and regulations'],
        ];

        DB::table('policy_categories')->insert($categories);
    }
}