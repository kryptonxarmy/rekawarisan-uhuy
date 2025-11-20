<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();

            // Judul misi
            $table->string('title');

            // Penjelasan misi
            $table->text('description')->nullable();

            // Poin yang didapat user
            $table->integer('points')->default(0);

            // Tipe misi:
            // daily = misi harian
            // weekly = mingguan
            // special = event tertentu
            $table->enum('type', ['daily', 'weekly', 'special'])->default('daily');

            // Status misi (aktif atau tidak)
            $table->boolean('is_active')->default(true);

            // Tanggal misi berlaku (khusus misi harian yang admin update tiap hari)
            $table->date('mission_date')->nullable();

            // Icon misi
            $table->string('icon')->nullable();

            // Waktu mulai & akhir (jika digunakan)
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // Relasi jika misi berhubungan dengan artikel/quiz
            $table->unsignedBigInteger('related_id')->nullable();
            $table->string('related_type')->nullable(); 
            // contoh: Article, Quiz, Video → polymorphic

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
