<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        Badge::insert([
            [
                'name' => 'Pemula',
                'description' => 'Mencapai 100 poin pertama',
                'points_requirement' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aktif',
                'description' => 'Mencapai 300 poin',
                'points_requirement' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Master',
                'description' => 'Mencapai 700 poin',
                'points_requirement' => 700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
