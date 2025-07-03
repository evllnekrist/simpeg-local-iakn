<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_jabatan', function (Blueprint $table) {
            $table->string('kode', 20)->primary(); // kode umum, PK
            $table->string('nama', 100);
            $table->text('keterangan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_jabatan');
    }
};
