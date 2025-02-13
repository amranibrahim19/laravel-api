<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch category IDs
        $categories = DB::table('categories')->get()->pluck('id', 'name');

        $expenses = [
            [
                'user_id' => 1,
                'title' => 'Groceries',
                'description' => 'Weekly grocery shopping including fruits, vegetables, and dairy.',
                'amount' => 75.00,
                'expense_date' => '2024-07-01',
                'category_id' => $categories['Food'] ?? null, // Fetch category_id for 'Food'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Gasoline',
                'description' => 'Fuel for the car for commuting to work and other trips.',
                'amount' => 50.00,
                'expense_date' => '2024-07-02',
                'category_id' => $categories['Transport'] ?? null, // Fetch category_id for 'Transport'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Dining Out',
                'description' => 'Dinner at a restaurant with friends.',
                'amount' => 45.00,
                'expense_date' => '2024-07-03',
                'category_id' => $categories['Food'] ?? null, // Fetch category_id for 'Food'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Internet Bill',
                'description' => 'Monthly internet service charge.',
                'amount' => 60.00,
                'expense_date' => '2024-07-04',
                'category_id' => $categories['Entertainment'] ?? null, // Fetch category_id for 'Entertainment'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Electricity Bill',
                'description' => 'Monthly payment for electricity usage.',
                'amount' => 90.00,
                'expense_date' => '2024-07-05',
                'category_id' => $categories['Health'] ?? null, // Fetch category_id for 'Health'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Gym Membership',
                'description' => 'Monthly fee for gym membership.',
                'amount' => 45.00,
                'expense_date' => '2024-07-06',
                'category_id' => $categories['Travel'] ?? null, // Fetch category_id for 'Travel'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Movie Tickets',
                'description' => 'Tickets for a movie night with family.',
                'amount' => 30.00,
                'expense_date' => '2024-07-07',
                'category_id' => $categories['Entertainment'] ?? null, // Fetch category_id for 'Entertainment'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Books',
                'description' => 'Purchase of new books for personal reading.',
                'amount' => 40.00,
                'expense_date' => '2024-07-08',
                'category_id' => $categories['Education'] ?? null, // Fetch category_id for 'Education'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Medical Expenses',
                'description' => "Payment for a doctor's appointment and prescription.",
                'amount' => 100.00,
                'expense_date' => '2024-07-09',
                'category_id' => $categories['Health'] ?? null, // Fetch category_id for 'Health'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Household Items',
                'description' => 'Purchase of cleaning supplies and other household necessities.',
                'amount' => 35.00,
                'expense_date' => '2024-07-10',
                'category_id' => $categories['Others'] ?? null, // Fetch category_id for 'Others'
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('expenses')->insert($expenses);
    }
}
