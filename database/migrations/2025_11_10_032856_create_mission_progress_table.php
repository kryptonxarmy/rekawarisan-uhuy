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
        Schema::create('mission_progress', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Pengguna
            $table->unsignedBigInteger('mission_id'); // Misi yang sedang dijalankan
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'claimed']); // Status misi
            $table->integer('progress_count'); // Jumlah artikel yang sudah dibaca sesuai ketentuan
            $table->integer('total_required'); // Jumlah total artikel di misi
            $table->timestamp('completed_at')->nullable(); // Waktu selesai semua artikel
            $table->timestamp('claimed_at')->nullable(); // Waktu user claim XP
            $table->timestamps(); // Update terakhir

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mission_id')->references('id')->on('missions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_progress');
    }
};
