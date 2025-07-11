<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Novel;

class NovelSeeder extends Seeder
{
    public function run(): void
    {
        Novel::insert([
            [
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'price' => 85000,
                'category_id' => 1, // Fiksi
                'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'price' => 99000,
                'category_id' => 2, // Non-Fiksi
                'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
