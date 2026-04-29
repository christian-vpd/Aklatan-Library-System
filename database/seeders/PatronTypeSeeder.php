<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatronTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Student',
                'description' => 'Enrolled students of the institution',
                'added_by' => 1,
            ],
            [
                'name' => 'Faculty',
                'description' => 'Teaching staff and professors',
                'added_by' => 1,
            ],
            [
                'name' => 'Staff',
                'description' => 'Administrative and support personnel',
                'added_by' => 1,
            ],
            [
                'name' => 'Alumni',
                'description' => 'Graduated students with limited access',
                'added_by' => 1,
            ],
            [
                'name' => 'Researcher',
                'description' => 'Internal or external researchers',
                'added_by' => 1,
            ],
            [
                'name' => 'Guest',
                'description' => 'Temporary or walk-in users',
                'added_by' => 1,
            ],
            [
                'name' => 'Administrator',
                'description' => 'Institution heads like principal or dean',
                'added_by' => 1,
            ],
        ];

        DB::table('patron_types')->insert($types);
    }
}