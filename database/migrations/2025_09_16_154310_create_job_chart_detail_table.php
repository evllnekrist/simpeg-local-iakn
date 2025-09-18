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
        Schema::create('job_chart_details', function (Blueprint $table) {
            $table->id();
            $table->string('job_chart_id'); // relasi ke master
            $table->string('jabatan');
            $table->integer('kls')->nullable();
            $table->integer('b')->default(0);
            $table->integer('k')->default(0);
            $table->integer('delta')->default(0);
            $table->string('type', 10)->nullable();
            $table->string('condition',255)->nullable();    
            $table->text('ref')->nullable(); // referensi id/nip karyawan terkait
            $table->timestamps();

            $table->foreign('job_chart_id')->references('id')->on('job_chart')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_chart_details');
    }
};
