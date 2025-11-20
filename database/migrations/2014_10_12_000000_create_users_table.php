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
            $table->id(); 
            $table->string('name'); 
            $table->string('username')->unique(); 
            $table->string('email')->unique(); 
            $table->string('password'); 
            
            // --- BAGIAN INI YANG DIUBAH ---
            // Ganti 'integer' menjadi 'string' agar bisa menyimpan Nama (huruf)
            $table->string('province'); 
            $table->string('regency'); 
            $table->string('district'); 
            // ------------------------------

            $table->enum('role', ['admin', 'enduser']); 
            $table->integer('xp')->default(0); 
            $table->integer('level')->default(1); 
            $table->unsignedBigInteger('badge_id')->nullable(); 
            $table->timestamps(); 

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