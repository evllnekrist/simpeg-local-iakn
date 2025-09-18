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
        Schema::create('meta_activity', function (Blueprint $table) {
            $table->string('name')->primary(); // Nama tabel yang dimonitor
            $table->timestamp('last_activity')->useCurrent(); // default = waktu sekarang
            $table->timestamps(); // created_at, updated_at (opsional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_activity');
    }
};
