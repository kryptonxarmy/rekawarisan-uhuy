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
        Schema::create('daily_mission_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_mission_id')->constrained('daily_missions')->onDelete('cascade');
            $table->enum('type', ['read', 'engage', 'quiz']);
            $table->integer('xp_reward')->default(0);
            $table->integer('required_count')->default(1);
            $table->integer('timer_seconds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_mission_tasks');
    }
};
