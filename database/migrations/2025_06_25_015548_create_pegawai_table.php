<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->nullable();
            $table->string('nik', 20)->nullable();
            $table->text('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 2)->nullable(); // 'p', 'l'
            $table->string('agama', 30)->nullable(); // e.g., islam, kristen, hindu
            $table->string('status_perkawinan', 20)->nullable(); // 'kawin', 'belum kawin'
            $table->string('hp', 15)->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('jenis_pegawai', 15)->nullable(); // administrasi, dosen, honorer
            $table->string('status_kepegawaian', 10)->nullable(); // pns, pppk, honorer
            $table->string('golongan_ruang', 50)->nullable();
            $table->string('jenis_jabatan', 20)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->text('jabatan_terakhir')->nullable();
            $table->unsignedBigInteger('penempatan')->nullable();
            $table->string('nip_atasan', 20)->nullable();
            $table->date('tmt_nip')->nullable();
            $table->date('tmt')->nullable();
            $table->string('karpeg', 20)->nullable();
            $table->string('karis', 20)->nullable();
            $table->string('kpe', 20)->nullable();
            $table->string('taspen', 20)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('nuptk', 20)->nullable();
            $table->string('nidn', 20)->nullable();
            $table->string('no_rekening', 50)->nullable();
            $table->string('bank_rekening', 20)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
