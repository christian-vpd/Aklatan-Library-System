<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibraryHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hours = [
            ['day' => 'Monday',    'open_time' => '07:30:00', 'close_time' => '17:00:00', 'is_closed' => false],
            ['day' => 'Tuesday',   'open_time' => '07:30:00', 'close_time' => '17:00:00', 'is_closed' => false],
            ['day' => 'Wednesday', 'open_time' => '07:30:00', 'close_time' => '17:00:00', 'is_closed' => false],
            ['day' => 'Thursday',  'open_time' => '07:30:00', 'close_time' => '17:00:00', 'is_closed' => false],
            ['day' => 'Friday',    'open_time' => '07:30:00', 'close_time' => '16:00:00', 'is_closed' => false],
            ['day' => 'Saturday',  'open_time' => null,        'close_time' => null,        'is_closed' => true],
            ['day' => 'Sunday',    'open_time' => null,        'close_time' => null,        'is_closed' => true],
        ];

        DB::table('library_hours')->insert($hours);
    }
}