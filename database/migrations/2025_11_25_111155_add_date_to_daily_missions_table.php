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
        Schema::table('daily_missions', function (Blueprint $table) {
            // Tambahkan kolom date, nullable supaya tidak error
            $table->date('date')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_missions', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
