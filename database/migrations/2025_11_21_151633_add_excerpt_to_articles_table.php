<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Migration intentionally left empty. The application no longer uses an
        // `excerpt` column and we avoid modifying the user's schema here to
        // prevent duplicate-column or table-exists errors during local runs.
        return;
    }

    public function down(): void
    {
        // No-op
        return;
    }
};
