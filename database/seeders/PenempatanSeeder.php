<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenempatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penempatan')->insert([
            ['nama' => 'Biro Administrasi Umum, Akademik dan Kemahasiswaan'],
            ['nama' => 'Bagian Umum dan Layanan Akademik'],
            ['nama' => 'FSKK'],
            ['nama' => 'Biro AUAK'],
            ['nama' => 'Sub Bagian Perencanaan, Keuangan dan Akuntansi'],
            ['nama' => 'Pendidikan Agama Kristen'],
            ['nama' => 'Teologi'],
            ['nama' => 'Musik Gereja'],
            ['nama' => 'Pastoral Konseling'],
            ['nama' => 'FKIPK'],
            ['nama' => 'Kepemimpinan Kristen'],
            ['nama' => 'Teologi S2'],
            ['nama' => 'PAK S2'],
            ['nama' => 'Pascasarjana'],
            ['nama' => 'Lembaga Penjamin Mutu'],
            ['nama' => 'Lembaga Penelitian Pengabdian Masyarakat'],
            ['nama' => 'Unit Bahasa'],
            ['nama' => 'Unit TIPD'],
            ['nama' => 'Unit Perpustakaan'],
            ['nama' => 'FISIKK'],
            ['nama' => 'Ruang WK I'],
            ['nama' => 'Ruang WK II'],
            ['nama' => 'Tata Usaha Fakultas FISKK'],
            ['nama' => 'Satuan Pengawas Internal'],
            ['nama' => 'Keuangan'],
            ['nama' => 'Tata Usaha Fakultas FKIPK'],
            ['nama' => 'Fakultas Keguruan dan Ilmu Pendidikan Kristen'],
            ['nama' => 'Fakultas Ilmu Sosial Keagamaan Kristen'],
            ['nama' => 'Fakultas Seni Keagamaan Kristen'],
            ['nama' => 'Seni Pertunjukan Keagamaan'],
            ['nama' => 'Sosiologi Agama'],
            ['nama' => 'Psikologi Kristen'],
            ['nama' => 'Manajemen Pendidikan Kristen'],
            ['nama' => 'Pendidikan Kristen Anak Usia Dini'],
            ['nama' => 'Pendidikan Musik Gereja'],
            ['nama' => 'Bimbingan dan Konseling Kristen'],
            ['nama' => 'PAK S3']
        ]);
    }
}
