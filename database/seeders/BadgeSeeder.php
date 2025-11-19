<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;
use Illuminate\Support\Facades\Schema; // Tambahkan import ini

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan Foreign Key agar bisa Truncate
        Schema::disableForeignKeyConstraints();

        // 2. Hapus data lama
        Badge::truncate();
        
        // Opsional: Hapus juga data di tabel pivot agar tidak error (orphaned data)
        // \DB::table('user_badges')->truncate(); 

        // 3. Nyalakan kembali pengecekan
        Schema::enableForeignKeyConstraints();

        // 4. Masukkan data baru yang benar
        $badges = [
            [
                'name' => 'Pejuang Literasi', // SAMA dengan Controller (100 poin)
                'image' => 'assets/jejakmaestro/badge/badge1.png', // Path lengkap
                'description' => 'Badge untuk 100 Poin',
                'points_requirement' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penjaga Tradisi', // SAMA dengan Controller (150 poin)
                'image' => 'assets/jejakmaestro/badge/badge2.png',
                'description' => 'Badge untuk 150 Poin',
                'points_requirement' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maestro Budaya', // SAMA dengan Controller (200 poin)
                'image' => 'assets/jejakmaestro/badge/badge3.png',
                'description' => 'Badge untuk 200 Poin',
                'points_requirement' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Badge::insert($badges);
    }
}