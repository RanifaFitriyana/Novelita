<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiksi',
                'description' => 'Kategori novel yang bersifat imajinatif atau rekaan.',
                'is_active' => true,
                'hub_category_id' => null,
            ],
            [
                'name' => 'Non-Fiksi',
                'description' => 'Kategori buku yang berdasarkan kenyataan atau fakta.',
                'is_active' => true,
                'hub_category_id' => null,
            ],
            [
                'name' => 'Biografi',
                'description' => 'Cerita hidup seseorang dalam bentuk narasi.',
                'is_active' => true,
                'hub_category_id' => null,
            ],
            [
                'name' => 'Fantasi',
                'description' => 'Cerita yang mengandung unsur magis atau dunia imajinatif.',
                'is_active' => true,
                'hub_category_id' => null,
            ],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
