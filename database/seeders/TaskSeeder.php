<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [];

        for ($i = 0; $i < 10; $i++) {
            $tasks[] = [
                'user_id' => 1,
                'title' => 'Task ' . ($i + 1),
                'content' => 'Content for task ' . ($i + 1),
                'status' => false,
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
