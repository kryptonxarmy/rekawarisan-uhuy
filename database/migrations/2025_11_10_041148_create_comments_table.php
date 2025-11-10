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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('article_id'); // Artikel yang dikomentari
            $table->unsignedBigInteger('user_id'); // Pengirim komentar
            $table->text('content'); // Isi komentar
            $table->integer('like_count'); // Jumlah suka komentar
            $table->timestamps(); // created_at & updated_at

            // Foreign keys
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
