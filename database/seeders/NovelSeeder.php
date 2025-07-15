<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Novel;

class NovelSeeder extends Seeder
{
    public function run(): void
    {
        $novels = [
            [
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'description' => 'Novel fiksi sejarah tentang aktivisme mahasiswa.',
                'price' => 85000,
                'stock' => 25,
                'sku' => 'SKU001',
                'weight' => 300,
                'image' => 'novel_images/dummy.jpg',
                'category' => 'Fiksi',
            ],
            [
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'description' => 'Panduan pengendalian emosi berdasarkan filosofi Stoikisme.',
                'price' => 95000,
                'stock' => 40,
                'sku' => 'SKU002',
                'weight' => 280,
                'image' => 'novel_images/dummy.jpg',
                'category' => 'Non-Fiksi',
            ],
            [
                'title' => 'Habibie & Ainun',
                'author' => 'B.J. Habibie',
                'description' => 'Kisah cinta Habibie dan Ainun yang menginspirasi.',
                'price' => 92000,
                'stock' => 15,
                'sku' => 'SKU003',
                'weight' => 320,
                'image' => 'novel_images/dummy.jpg',
                'category' => 'Biografi',
            ],
            [
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'description' => 'Petualangan dunia paralel dalam genre fantasi.',
                'price' => 78000,
                'stock' => 30,
                'sku' => 'SKU004',
                'weight' => 290,
                'image' => 'novel_images/dummy.jpg',
                'category' => 'Fantasi',
            ],
        ];

        foreach ($novels as $data) {
            $category = Category::where('name', $data['category'])->first();

            if ($category) {
                Novel::create([
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'sku' => $data['sku'],
                    'weight' => $data['weight'],
                    'image' => $data['image'],
                    'category_id' => $category->id,
                    'is_active' => true,
                    'hub_product_id' => null,
                ]);
            }
        }
    }
}
