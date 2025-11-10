<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mission_article_progress', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('mission_progress_id'); // Progress misi induk
            $table->unsignedBigInteger('mission_article_id'); // Artikel dalam misi
            $table->timestamp('start_time'); // Waktu mulai baca
            $table->timestamp('end_time'); // Waktu selesai baca
            $table->integer('duration_seconds'); // Lama waktu membaca
            $table->boolean('is_completed'); // True jika durasi ≥ min_read_time
            $table->timestamp('created_at'); // Waktu dibuat

            // Foreign keys
            $table->foreign('mission_progress_id')->references('id')->on('mission_progress');
            $table->foreign('mission_article_id')->references('id')->on('mission_articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_article_progress');
    }
};
