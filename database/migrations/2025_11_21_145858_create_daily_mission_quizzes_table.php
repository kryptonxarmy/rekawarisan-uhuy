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
        Schema::create('daily_mission_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('daily_mission_tasks')->onDelete('cascade');
            $table->text('question');
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_mission_quizzes');
    }
};
