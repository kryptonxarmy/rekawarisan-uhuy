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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('mission_id'); // Misi quiz
            $table->unsignedBigInteger('quiz_id'); // Kuis yang dihubungkan
            $table->integer('passing_score'); // Skor minimal lulus
            $table->timestamp('created_at'); // Waktu dibuat

            // Foreign keys
            $table->foreign('mission_id')->references('id')->on('missions');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
