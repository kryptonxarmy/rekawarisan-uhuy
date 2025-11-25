<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('body');
                $table->string('cover')->nullable();
                $table->enum('status', ['draft','pending','published'])->default('pending');
                $table->unsignedBigInteger('views')->default(0);
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
