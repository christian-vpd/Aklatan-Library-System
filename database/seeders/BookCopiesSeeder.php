<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookCopiesSeeder extends Seeder
{
    public function run(): void
    {
        $copies = [];

        foreach ([1, 2, 3] as $bookId) {
            for ($i = 1; $i <= 3; $i++) {
                $copies[] = [
                    'book_id' => $bookId,
                    'ascension_number' => 'BK-' . $bookId . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'barcode' => 'BC-' . Str::uuid(),

                    'status' => 'available',
                    'condition' => 'good',

                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('book_copies')->insert($copies);
    }
}