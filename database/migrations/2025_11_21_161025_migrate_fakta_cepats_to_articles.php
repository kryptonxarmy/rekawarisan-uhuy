<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing fakta_cepats to articles
        DB::statement("
            INSERT INTO articles (title, content, img_url, type, status, is_verified, author_type, created_at, updated_at)
            SELECT 
                title,
                content,
                CONCAT('/storage/', image) as img_url,
                'fakta_cepat' as type,
                CASE WHEN is_active = 1 THEN 'approved' ELSE 'pending' END as status,
                is_active as is_verified,
                'admin' as author_type,
                created_at,
                updated_at
            FROM fakta_cepats
            WHERE image IS NOT NULL
        ");
        
        // Insert fakta_cepats without images
        DB::statement("
            INSERT INTO articles (title, content, type, status, is_verified, author_type, created_at, updated_at)
            SELECT 
                title,
                content,
                'fakta_cepat' as type,
                CASE WHEN is_active = 1 THEN 'approved' ELSE 'pending' END as status,
                is_active as is_verified,
                'admin' as author_type,
                created_at,
                updated_at
            FROM fakta_cepats
            WHERE image IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove migrated fakta_cepat articles
        DB::table('articles')->where('type', 'fakta_cepat')->delete();
    }
};
