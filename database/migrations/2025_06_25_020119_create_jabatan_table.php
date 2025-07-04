<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->string('kode', 20)->primary(); // kode jabatan
            $table->string('nama', 100);
            $table->string('kategori', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
