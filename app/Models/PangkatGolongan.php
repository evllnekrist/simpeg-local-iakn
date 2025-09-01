<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PangkatGolongan extends Model
{
    protected $table = 'pangkat_golongan';
    protected $fillable = ['combined', 'golongan', 'ruang', 'pangkat'];

    public function get_combined_attribute()
    {
        return "{$this->golongan}.{$this->ruang}";
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'golongan_ruang', 'combined');
    }
}
