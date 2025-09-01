<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pangkat_golongan', function (Blueprint $table) {
            $table->string('combined', 10);
            $table->string('golongan', 5);
            $table->string('ruang', 5);
            $table->string('pangkat', 30);
            $table->primary(['combined', 'golongan', 'ruang']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pangkat_golongan');
    }
};
