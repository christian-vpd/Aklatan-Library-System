<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BorrowSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'patron_type_id' => 1, // Student
                'max_books'      => 3,
                'borrow_days'    => 7,
            ],
            [
                'patron_type_id' => 2, // Faculty
                'max_books'      => 5,
                'borrow_days'    => 14,
            ],
            [
                'patron_type_id' => 3, // Staff
                'max_books'      => 4,
                'borrow_days'    => 10,
            ],
            [
                'patron_type_id' => 4, // Alumni
                'max_books'      => 2,
                'borrow_days'    => 5,
            ],
            [
                'patron_type_id' => 5, // Researcher
                'max_books'      => 5,
                'borrow_days'    => 14,
            ],
            [
                'patron_type_id' => 6, // Guest
                'max_books'      => 1,
                'borrow_days'    => 3,
            ],
            [
                'patron_type_id' => 7, // Administrator
                'max_books'      => 5,
                'borrow_days'    => 14,
            ],
        ];

        DB::table('borrow_settings')->insert($settings);
    }
}