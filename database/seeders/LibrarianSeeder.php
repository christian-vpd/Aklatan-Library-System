<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Airi Satou',
                'username' => 'adminairi2026',
                'email'=> 'airisatou@example.com',
                'password'=> bcrypt('adminairi2026'),
                'role' => 'librarian',
            ],
        ];

        DB::table('users')->insert($users);

        // Fetch inserted users
        $insertedUsers = DB::table('users')
            ->whereIn('email', [
                'airisatou@example.com',
            ])
            ->get()
            ->keyBy('email');

        $librarians = [
            [
                'user_id' => $insertedUsers['airisatou@example.com']->id,
                'librarian_code' => 'LIBRA2026001',
                'last_name' => 'Satou',
                'first_name' => 'Airi',
                'gender' => 'Female',
                'contact_number' => '09123456789',
            ]
        ];

        DB::table('librarians')->insert($librarians);

    }
}
