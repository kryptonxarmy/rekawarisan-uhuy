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
            $table->unsignedBigInteger('mission_article_id');  // Artikel dalam misi

            $table->timestamp('start_time')->nullable(); // Waktu mulai baca
            $table->timestamp('end_time')->nullable();   // Waktu selesai baca

            $table->integer('duration_seconds')->default(0); // Lama waktu membaca
            $table->boolean('is_completed')->default(false); // True jika durasi ≥ min_read_time

            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('mission_progress_id')
                ->references('id')
                ->on('mission_progress')
                ->onDelete('cascade');

            $table->foreign('mission_article_id')
                ->references('id')
                ->on('mission_articles')
                ->onDelete('cascade');
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
