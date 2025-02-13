<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Food', 'icon' => 'strokeRoundedVegetarianFood', 'color' => '#FFAB91', 'type' => 'expense'], // Soft Coral
            ['name' => 'Transport', 'icon' => 'strokeRoundedBus03', 'color' => '#90CAF9', 'type' => 'expense'], // Light Blue
            ['name' => 'Shopping', 'icon' => 'strokeRoundedShoppingCart01', 'color' => '#A5D6A7', 'type' => 'expense'], // Light Green
            ['name' => 'Entertainment', 'icon' => 'strokeRoundedTv01', 'color' => '#CE93D8', 'type' => 'expense'], // Light Purple
            ['name' => 'Health', 'icon' => 'strokeRoundedHospital02', 'color' => '#FFCC80', 'type' => 'expense'], // Light Orange
            ['name' => 'Travel', 'icon' => 'strokeRoundedAirplaneTakeOff01', 'color' => '#80CBC4', 'type' => 'expense'], // Light Teal
            ['name' => 'Education', 'icon' => 'strokeRoundedBook02', 'color' => '#F48FB1', 'type' => 'expense'], // Light Pink
            ['name' => 'Others', 'icon' => 'strokeRoundedMoreHorizontalCircle02', 'color' => '#E0E0E0', 'type' => 'expense'], // Light Grey
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'description' => 'Category for ' . $category['name'] . ' ' . $category['type'] . '.',
                'icon' => $category['icon'],
                'color' => $category['color'],
                'type' => $category['type'],
            ]);
        }
    }
}
