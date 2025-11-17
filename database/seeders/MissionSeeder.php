<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('missions')->insert([
            [
                'title' => 'Membaca Artikel Budaya',
                'description' => 'Baca 1 artikel budaya selama minimal 1 menit.',
                'points' => 10,
                'type' => 'daily',
                'is_active' => true,
                'mission_date' => now()->toDateString(),
                'icon' => null,
                'start_time' => null,
                'end_time' => null,
                'related_id' => null,
                'related_type' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Menjawab Kuis Budaya',
                'description' => 'Selesaikan 1 kuis budaya dengan benar.',
                'points' => 40,
                'type' => 'daily',
                'is_active' => true,
                'mission_date' => now()->toDateString(),
                'icon' => null,
                'start_time' => null,
                'end_time' => null,
                'related_id' => null,
                'related_type' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Upload Konten Budaya',
                'description' => 'Upload 1 foto/video budaya ke aplikasi.',
                'points' => 60,
                'type' => 'daily',
                'is_active' => true,
                'mission_date' => now()->toDateString(),
                'icon' => null,
                'start_time' => null,
                'end_time' => null,
                'related_id' => null,
                'related_type' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
