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
        Schema::table('articles', function (Blueprint $table) {

            // Hanya tambahkan kolom jika belum ada
            if (!Schema::hasColumn('articles', 'type')) {

                // Jika kolom 'status' ada → taruh setelah 'status'
                if (Schema::hasColumn('articles', 'status')) {
                    $table->enum('type', ['article', 'fakta_cepat'])
                        ->default('article')
                        ->after('status');
                } 
                // Jika tidak ada → taruh setelah 'id'
                else {
                    $table->enum('type', ['article', 'fakta_cepat'])
                        ->default('article')
                        ->after('id');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
