<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // No-op: the application no longer requires an `excerpt` column.
        return;
    }

    public function down()
    {
        // No-op
        return;
    }
};
