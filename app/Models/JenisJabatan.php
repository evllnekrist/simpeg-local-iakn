<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisJabatan extends Model
{
    protected $table = 'jenis_jabatan';
    protected $fillable = ['kode', 'nama'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jenis_jabatan', 'kode');
    }
}
