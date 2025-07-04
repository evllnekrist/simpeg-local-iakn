<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = ['kode', 'nama'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jabatan', 'kode');
    }
}
