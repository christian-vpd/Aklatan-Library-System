<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            // Borrowing (category 1)
            ['policy_category_id' => 1, 'title' => 'Maximum Borrowing Limit',    'body' => 'Patrons may borrow books based on their patron type. Students may borrow up to 3 books, faculty up to 5, and staff up to 4 at a time.', 'is_active' => true],
            ['policy_category_id' => 1, 'title' => 'Borrowing Duration',          'body' => 'Books must be returned within the allowed borrowing period. Students have 7 days, faculty 14 days, and staff 10 days.', 'is_active' => true],
            ['policy_category_id' => 1, 'title' => 'Reference Books',             'body' => 'Reference books, periodicals, and special collections are for in-library use only and cannot be borrowed.', 'is_active' => true],

            // Conduct (category 2)
            ['policy_category_id' => 2, 'title' => 'No Food and Drinks',         'body' => 'Food and drinks are strictly prohibited inside the library to protect the books and maintain cleanliness.', 'is_active' => true],
            ['policy_category_id' => 2, 'title' => 'Silence Policy',             'body' => 'Patrons are expected to maintain silence or speak in low voices inside the library at all times.', 'is_active' => true],
            ['policy_category_id' => 2, 'title' => 'Proper Handling of Books',   'body' => 'Patrons must handle books and library materials with care. Writing, tearing, or defacing any material is strictly prohibited.', 'is_active' => true],

            // Fines (category 3)
            ['policy_category_id' => 3, 'title' => 'Overdue Fines',              'body' => 'A fine of ₱2.00 per day will be charged for every overdue book. Fines must be settled before a patron can borrow again.', 'is_active' => true],
            ['policy_category_id' => 3, 'title' => 'Lost Book Penalty',          'body' => 'Patrons who lose a borrowed book will be charged based on the current price of the book. The librarian will assess the amount accordingly.', 'is_active' => true],
            ['policy_category_id' => 3, 'title' => 'Damaged Book Penalty',       'body' => 'Patrons who return damaged books will be assessed a penalty based on the extent of damage as evaluated by the librarian.', 'is_active' => true],

            // Membership (category 4)
            ['policy_category_id' => 4, 'title' => 'Valid ID Requirement',       'body' => 'A valid school ID is required to borrow or reserve any book from the library collection.', 'is_active' => true],
            ['policy_category_id' => 4, 'title' => 'Patron Registration',        'body' => 'All patrons must be registered in the library system before they can borrow or reserve books.', 'is_active' => true],

            // General (category 5)
            ['policy_category_id' => 5, 'title' => 'Library Hours',              'body' => 'The library is open Monday to Thursday from 7:30 AM to 5:00 PM, and Friday from 7:30 AM to 4:00 PM. Closed on weekends and holidays.', 'is_active' => true],
            ['policy_category_id' => 5, 'title' => 'Personal Belongings',        'body' => 'Patrons are responsible for their own personal belongings. The library is not liable for any lost or stolen items.', 'is_active' => true],
        ];

        DB::table('policies')->insert($policies);
    }
}