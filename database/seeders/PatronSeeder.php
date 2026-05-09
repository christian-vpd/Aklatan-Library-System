<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PatronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'username' => 'PAT2026001',
                'email'=> 'johndoe@example.com',
                'password'=> bcrypt('PAT2026001'),
                'role' => 'patron',
            ],
            [
                'name' => 'Jane Doe',
                'username' => 'PAT2026002',
                'email'=> 'janedoe@example.com',
                'password'=> bcrypt('PAT2026002'),
                'role' => 'patron',
            ],
            [
                'name' => 'John Smith',
                'username' => 'PAT2026003',
                'email'=> 'johnsmith@example.com',
                'password'=> bcrypt('PAT2026003'),
                'role' => 'patron',
            ],
        ];

        DB::table('users')->insert($users);

        // Fetch inserted users
        $insertedUsers = DB::table('users')
            ->whereIn('email', [
                'johndoe@example.com',
                'janedoe@example.com',
                'johnsmith@example.com'
            ])
            ->get()
            ->keyBy('email');

        $patrons = [
            [
                'user_id' => $insertedUsers['johndoe@example.com']->id,
                'patron_code' => 'PAT-2026-001',
                'last_name' => 'Doe',
                'first_name' => 'John',
                'patron_type_id' => 1,
                'gender' => 'Male',
                'contact_number' => '09123456789',
            ],
            [
                'user_id' => $insertedUsers['janedoe@example.com']->id,
                'patron_code' => 'PAT-2026-002',
                'last_name' => 'Doe',
                'first_name' => 'Jane',
                'patron_type_id' => 1,
                'gender' => 'Female',
                'contact_number' => '09123456789',
            ],
            [
                'user_id' => $insertedUsers['johnsmith@example.com']->id,
                'patron_code' => 'PAT-2026-003',
                'last_name' => 'Smith',
                'first_name' => 'John',
                'patron_type_id' => 1,
                'gender' => 'Male',
                'contact_number' => '09123456789',
            ],
        ];

        DB::table('patrons')->insert($patrons);
    }
}
