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
        Schema::create('daily_mission_user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('daily_mission_tasks')->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->datetime('completed_at')->nullable();
            $table->integer('earned_xp')->default(0);
            $table->timestamps();
            
            $table->unique(['user_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_mission_user_progress');
    }
};
