<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Budaya',
                'description' => 'Artikel tentang budaya dan tradisi warisan'
            ],
            [
                'name' => 'Sejarah',
                'description' => 'Artikel tentang sejarah dan peristiwa bersejarah'
            ],
            [
                'name' => 'Tradisi',
                'description' => 'Artikel tentang tradisi dan adat istiadat'
            ],
            [
                'name' => 'Kuliner',
                'description' => 'Artikel tentang makanan dan minuman tradisional'
            ],
            [
                'name' => 'Seni',
                'description' => 'Artikel tentang seni dan kerajinan tradisional'
            ],
            [
                'name' => 'Arsitektur',
                'description' => 'Artikel tentang bangunan dan arsitektur bersejarah'
            ],
            [
                'name' => 'Bahasa',
                'description' => 'Artikel tentang bahasa daerah dan sastra'
            ],
            [
                'name' => 'Ritual',
                'description' => 'Artikel tentang upacara dan ritual tradisional'
            ]
        ];

        foreach ($categories as $category) {
            ArticleCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
