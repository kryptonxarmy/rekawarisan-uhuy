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
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Pengguna
            $table->string('province'); // Provinsi pengguna
            $table->string('regency'); // Kabupaten pengguna
            $table->integer('total_points'); // Total XP / poin
            $table->integer('rank'); // Peringkat di daerahnya
            $table->timestamp('updated_at'); // Terakhir diperbarui

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
    }
};
