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
        Schema::table('fakta_cepats', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->after('created_at');
            $table->string('author_type')->default('admin')->after('author_id');
            $table->boolean('is_verified')->default(false)->after('author_type');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('is_verified');
            $table->string('img_url')->nullable()->after('status');
            $table->string('featured_image')->nullable()->after('img_url');
            $table->timestamp('updated_at')->nullable()->after('featured_image');
            
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fakta_cepats', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['author_id', 'author_type', 'is_verified', 'status', 'img_url', 'featured_image', 'updated_at']);
        });
    }
};
