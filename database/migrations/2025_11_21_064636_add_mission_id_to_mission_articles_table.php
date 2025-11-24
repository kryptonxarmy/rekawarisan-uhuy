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
        Schema::table('mission_articles', function (Blueprint $table) {
            // Check and add columns only if they don't exist
            if (!Schema::hasColumn('mission_articles', 'mission_id')) {
                $table->unsignedBigInteger('mission_id')->after('id');
                $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
            }

            if (!Schema::hasColumn('mission_articles', 'article_id')) {
                $table->unsignedBigInteger('article_id')->after('mission_id');
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            }

            if (!Schema::hasColumn('mission_articles', 'min_read_time')) {
                $table->integer('min_read_time')->after('article_id')->comment('Minimum reading time in minutes');
            }

            if (!Schema::hasColumn('mission_articles', 'order_index')) {
                $table->integer('order_index')->after('min_read_time')->comment('Order of article in mission');
            }
        });

        // Add index separately after all columns are created
        Schema::table('mission_articles', function (Blueprint $table) {
            if (Schema::hasColumn('mission_articles', 'mission_id') &&
                Schema::hasColumn('mission_articles', 'order_index')) {
                $table->index(['mission_id', 'order_index']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_articles', function (Blueprint $table) {
            if (Schema::hasColumn('mission_articles', 'mission_id')) {
                $table->dropForeign(['mission_id']);
            }
            if (Schema::hasColumn('mission_articles', 'article_id')) {
                $table->dropForeign(['article_id']);
            }

            // Drop index if exists
            $indexes = Schema::getConnection()->getDoctrineSchemaManager()
                      ->listTableIndexes('mission_articles');
            if (isset($indexes['mission_articles_mission_id_order_index_index'])) {
                $table->dropIndex(['mission_id', 'order_index']);
            }

            $table->dropColumn(['mission_id', 'article_id', 'min_read_time', 'order_index']);
        });
    }
};
