<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;
    protected $table = 'pegawai'; // table ini ditulis dalam Bahasa Indonesia (beserta kolomnya) untuk menghindari kesalah pahaman istilah dalam proses bisnis yang dimaksud
    protected $guarded = []; // Semua kolom bisa diisi secara massal

    public function pangkat_golongan()
    {
        return $this->belongsTo(PangkatGolongan::class, 'golongan_ruang', 'combined');
    }

    public function jenis_jabatan()
    {
        return $this->belongsTo(JenisJabatan::class, 'jenis_jabatan', 'kode');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan', 'kode');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'penempatan', 'id');
    }
}
