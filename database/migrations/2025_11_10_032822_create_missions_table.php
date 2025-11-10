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
        Schema::create('missions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Nama misi
            $table->text('description'); // Deskripsi misi
            $table->enum('type', ['read', 'quiz']); // Jenis misi
            $table->integer('xp_reward'); // XP reward setelah menyelesaikan semua artikel/quiz
            $table->enum('status', ['draft', 'active', 'inactive', 'expired']); // Status misi
            $table->unsignedBigInteger('created_by'); // Admin pembuat misi
            $table->timestamps(); // created_at & updated_at

            // Foreign key
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
