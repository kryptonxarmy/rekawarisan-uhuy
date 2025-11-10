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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('full_name'); // Nama lengkap
            $table->string('username')->unique(); // Username unik
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Password terenkripsi
            $table->string('province'); // Provinsi asal
            $table->string('regency'); // Kabupaten/Kota asal
            $table->enum('role', ['admin', 'enduser']); // Role pengguna
            $table->integer('xp')->default(0); // Total XP pengguna
            $table->integer('level')->default(1); // Level pengguna
            $table->unsignedBigInteger('badge_id')->nullable(); // Badge yang sedang dimiliki
            $table->timestamps(); // created_at & updated_at

            // Foreign key
            $table->foreign('badge_id')->references('id')->on('badges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
