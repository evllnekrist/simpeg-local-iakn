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
        Schema::create('job_chart', function (Blueprint $table) {
            $table->unsignedSmallInteger('position');  
            $table->string('id')->primary();          // ex: 'rektor', 'kabiro-auak'
            $table->string('parent_id')->nullable()->index();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('type', 10)->nullable();   
            $table->string('condition',255)->nullable();    
            $table->text('ref')->nullable(); // referensi id/nip karyawan terkait
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_chart');
    }
};
