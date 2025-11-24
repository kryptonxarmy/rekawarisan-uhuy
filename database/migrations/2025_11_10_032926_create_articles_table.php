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
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Judul artikel
            $table->longText('content'); // Isi artikel
            $table->string('img_url'); // Gambar utama
            $table->unsignedBigInteger('category_id'); // Kategori artikel
            $table->string('province'); // Provinsi asal budaya
            $table->string('regency'); // Kabupaten/Kota asal budaya
            $table->unsignedBigInteger('author_id'); // Penulis artikel
            $table->enum('author_type', ['admin', 'user']); // Tipe penulis
            $table->unsignedBigInteger('fakta_cepat_id')->nullable(); // Fakta cepat terkait
            $table->boolean('is_verified')->default(false); // Status verifikasi artikel
            $table->integer('like_count')->default(0); // Jumlah suka
            $table->integer('view_count')->default(0); // Jumlah dibaca
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected']); // Status publikasi
            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('article_categories');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('fakta_cepat_id')->references('id')->on('fakta_cepats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
