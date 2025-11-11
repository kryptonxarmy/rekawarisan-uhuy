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
        Schema::create('fakta_cepats', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama'); // Nama budaya
            $table->string('asal'); // Daerah asal
            $table->string('pencipta'); // Pencipta / penggagas
            $table->string('periode'); // Masa / era
            $table->string('status_unesco'); // Status pengakuan UNESCO
            $table->string('kategori'); // Jenis budaya
            $table->text('penampilan'); // Ciri khas / deskripsi singkat
            $table->timestamp('created_at')->useCurrent(); // Waktu dibuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakta_cepats');
    }
};
