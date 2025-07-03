<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['kode' => 'KARO-KAUAK', 'nama' => 'Kepala Biro Administrasi Umum, Akademik, dan Kemahasiswaan', 'kategori' => 'Jabatan Struktural (JPT Pratama)'],
            ['kode' => 'KABAG-ULA', 'nama' => 'Kepala Bagian Umum dan Layanan Akademik', 'kategori' => 'Jabatan Struktural (Administrator)'],
            ['kode' => '1563', 'nama' => 'Lektor Kepala', 'kategori' => 'JFT Dosen (Ahli Madya)'],
            ['kode' => '1562', 'nama' => 'Lektor', 'kategori' => 'JFT Dosen (Ahli Muda)'],
            ['kode' => '1561', 'nama' => 'Asisten Ahli', 'kategori' => 'JFT Dosen (Ahli Pertama)'],
            ['kode' => 'C-1561', 'nama' => 'Calon Dosen Asisten Ahli', 'kategori' => 'CPNS (Menuju JFT Ahli Pertama)'],
            ['kode' => '5210', 'nama' => 'Analis SDM Aparatur', 'kategori' => 'JFT Analis SDM'],
            ['kode' => '1540', 'nama' => 'Pustakawan', 'kategori' => 'JFT Pustakawan'],
            ['kode' => '1530', 'nama' => 'Perencana', 'kategori' => 'JFT Perencana'],
            ['kode' => '1535', 'nama' => 'Pranata Komputer', 'kategori' => 'JFT Pranata Komputer'],
            ['kode' => '1520', 'nama' => 'Pranata Hubungan Masyarakat', 'kategori' => 'JFT Kehumasan'],
            ['kode' => '1528', 'nama' => 'Pengembang Teknologi Pembelajaran', 'kategori' => 'JFT PTP (Kemendikbud)'],
            ['kode' => '5240', 'nama' => 'Analis Pengelola Keuangan APBN', 'kategori' => 'JFT Keuangan APBN'],
            ['kode' => '1538', 'nama' => 'Arsiparis', 'kategori' => 'JFT Arsiparis'],
            ['kode' => '5202', 'nama' => 'Analis Kebijakan', 'kategori' => 'JFT Analis Kebijakan'],
            ['kode' => '1525', 'nama' => 'Auditor', 'kategori' => 'JFT Auditor'],
            ['kode' => 'penata_layanan_operasional', 'nama' => 'Penata Layanan Operasional', 'kategori' => 'Jabatan Pelaksana Umum'],
            ['kode' => 'pengelola_layanan_operasional', 'nama' => 'Pengelola Layanan Operasional', 'kategori' => 'Jabatan Pelaksana Umum'],
            ['kode' => 'operator_layanan_operasional', 'nama' => 'Operator Layanan Operasional', 'kategori' => 'Jabatan Pelaksana Umum'],
        ]);
    }
}
