<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisJabatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_jabatan')->insert([
            ['kode' => '1', 'nama' => 'JPT Madya', 'keterangan' => 'Jabatan Pimpinan Tinggi (JPT) Madya'],
            ['kode' => '2', 'nama' => 'JPT Pratama', 'keterangan' => 'Jabatan Pimpinan Tinggi Pratama'],
            ['kode' => '3', 'nama' => 'Administrator', 'keterangan' => 'Jabatan Administrator'],
            ['kode' => '4', 'nama' => 'Pengawas', 'keterangan' => 'Jabatan Pengawas'],
            ['kode' => '5', 'nama' => 'JF Ahli Madya', 'keterangan' => 'Jabatan Fungsional Ahli Madya'],
            ['kode' => '6', 'nama' => 'JF Ahli Muda', 'keterangan' => 'Jabatan Fungsional Ahli Muda'],
            ['kode' => '7', 'nama' => 'JF Ahli Pertama', 'keterangan' => 'Jabatan Fungsional Ahli Pertama'],
            ['kode' => '8', 'nama' => 'JF Terampil (Pelaksana/Analis)', 'keterangan' => 'Jabatan Fungsional Terampil/Pelaksana'],
            ['kode' => '91', 'nama' => 'CPNS Calon Dosen', 'keterangan' => 'CPNS untuk JFT Dosen (sementara)'],
            ['kode' => '92', 'nama' => 'JFT Dosen (Ahli Pertama – Madya)', 'keterangan' => 'Jabatan Fungsional Tertentu (Dosen)'],
            ['kode' => '93', 'nama' => 'CPNS Calon JF Ahli Pertama', 'keterangan' => 'CPNS calon JF umum (bukan hanya dosen)'],
            ['kode' => '99', 'nama' => 'Pelaksana (Non-JF)', 'keterangan' => 'Jabatan Pelaksana Umum (non fungsional)'],
        ]);
    }
}
