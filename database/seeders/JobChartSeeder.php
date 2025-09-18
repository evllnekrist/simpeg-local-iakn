<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JobChartSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // === MASTER NODES ===
        $masters = [
            [ 'position'=> 0, 'id' => 'rektor', 'parent_id' => null, 'title' => 'Rektor', 'subtitle' => 'IAKN Palangka Raya' ],
            [ 'position'=> 1, 'id' => 'rektor-wakil-1', 'parent_id' => 'rektor', 'title' => 'Wakil Rektor 1', 'subtitle' => 'Bidang Akademik, Kemahasiswaan, Kelembagaan dan Kerja sama' ],
            [ 'position'=> 2, 'id' => 'rektor-wakil-2', 'parent_id' => 'rektor', 'title' => 'Wakil Rektor 2', 'subtitle' => 'Bidang Administrasi Umum, Perencanaan dan Keuangan' ],
            [ 'position'=> 3, 'id' => 'kabiro-auak', 'parent_id' => 'rektor',     'title' => 'Kepala Biro', 'subtitle' => 'Administrasi Umum, Akademik dan Kemahasiswaan' ],
            [ 'position'=> 4, 'id' => 'kjf-biro-auak','parent_id'=>'kabiro-auak','title' => 'Kelompok Jabatan Fungsional','subtitle'=>null ],
            [ 'position'=> 5, 'id' => 'kjp-biro-auak','parent_id'=>'kabiro-auak','title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
            [ 'position'=> 6, 'id' => 'kabag-ula',   'parent_id' => 'kabiro-auak','title' => 'Kepala Bagian','subtitle'=>'Umum dan Layanan Akademik' ],
            [ 'position'=> 7, 'id' => 'kjf-bag-ula', 'parent_id' => 'kabag-ula', 'title' => 'Kelompok Jabatan Fungsional','subtitle'=>null ],
            [ 'position'=> 8, 'id' => 'kjp-bag-ula', 'parent_id' => 'kabag-ula', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
            [ 'position'=> 9, 'id' => 'dekan', 'parent_id' => 'rektor', 'title' => 'Dekan','subtitle'=>'FKIPK | FISKK | FSKK' ],
            [ 'position'=> 10, 'id' => 'kasubbag-tu',   'parent_id' => 'dekan','title' => 'Kepala Sub Bagian TU','subtitle'=>'FKIPK | FISKK | FSKK' ],
            [ 'position'=> 11, 'id' => 'kjf-dosen', 'parent_id' => 'dekan', 'title' => 'Fungsional Dosen','subtitle'=>'FKIPK | FISKK | FSKK'],
            [ 'position'=> 12, 'id' => 'kjf-subbag-tu','parent_id'=>'kasubbag-tu','title' => 'Kelompok Jabatan Fungsional','subtitle'=>'FKIPK | FISKK | FSKK'],
            [ 'position'=> 13, 'id' => 'kjp-subbag-tu', 'parent_id' => 'kasubbag-tu', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>'FKIPK | FISKK | FSKK'],
            [ 'position'=> 14, 'id' => 'direktur', 'parent_id' => 'rektor', 'title' => 'Direktur','subtitle'=>'Pascasarjana' ],
            [ 'position'=> 15, 'id' => 'kjf-dosen-pascasarjana', 'parent_id' => 'direktur', 'title' => 'Fungsional Dosen','subtitle'=>'Pascasarjana'],
            [ 'position'=> 16, 'id' => 'kjf-pascasarjana','parent_id'=>'direktur','title' => 'Kelompok Jabatan Fungsional','subtitle'=>'Pascasarjana'],
            [ 'position'=> 17, 'id' => 'kjp-pascasarjana', 'parent_id' => 'direktur', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>'Pascasarjana'],
            [ 'position'=> 18, 'id' => 'ka-spi', 'parent_id' => 'rektor', 'title' => 'Kepala SPI','subtitle'=>'Satuan Pengawasan Internal' ],
            [ 'position'=> 19, 'id' => 'sekre-spi', 'parent_id' => 'ka-spi', 'title' => 'Sekertaris SPI','subtitle'=>null ],
            [ 'position'=> 20, 'id' => 'kjf-spi', 'parent_id' => 'ka-spi', 'title' => 'Kelompok Jabatan Fungsional','subtitle'=>null ],
            [ 'position'=> 21, 'id' => 'kjp-spi', 'parent_id' => 'sekre-spi', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
            [ 'position'=> 22, 'id' => 'ka-lpm', 'parent_id' => 'rektor', 'title' => 'Kepala LPM','subtitle'=>'Lembaga Penjaminan Mutu' ],
            [ 'position'=> 23, 'id' => 'sekre-lpm', 'parent_id' => 'ka-lpm', 'title' => 'Sekertaris LPM','subtitle'=>null ],
            [ 'position'=> 24, 'id' => 'kjfp-lpm', 'parent_id' => 'ka-lpm', 'title' => 'Kelompok Jabatan Fungsional/Pelaksana','subtitle'=>null ],
            [ 'position'=> 25, 'id' => 'kjp-lpm', 'parent_id' => 'sekre-lpm', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
            [ 'position'=> 26, 'id' => 'ka-lp2m', 'parent_id' => 'rektor', 'title' => 'Kepala LP2M','subtitle'=>'Lembaga Penelitian & Pengabdian Masyarakat' ],
            [ 'position'=> 27, 'id' => 'sekre-lp2m', 'parent_id' => 'ka-lp2m', 'title' => 'Sekertaris LP2M','subtitle'=>null ],
            [ 'position'=> 28, 'id' => 'kjfp-lp2m', 'parent_id' => 'ka-lp2m', 'title' => 'Kelompok Jabatan Fungsional/Pelaksana','subtitle'=>null ],
            [ 'position'=> 29, 'id' => 'kjp-lp2m', 'parent_id' => 'sekre-lp2m', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
            [ 'position'=> 30, 'id' => 'ka-perpustakaan', 'parent_id' => 'rektor', 'title' => 'Kepala UPT Perpustakaan','subtitle'=>'Unit Penunjang Akademik: Perpustakaan' ],
            [ 'position'=> 31, 'id' => 'kjfp-perpustakaan', 'parent_id' => 'ka-perpustakaan', 'title' => 'Kelompok Jabatan Fungsional/Pelaksana','subtitle'=>null ],
            [ 'position'=> 32, 'id' => 'ka-tipd', 'parent_id' => 'rektor', 'title' => 'Kepala UPT TIPD','subtitle'=>'Unit Penunjang Akademik: Teknologi Informasi dan Pangkalan Data' ],
            [ 'position'=> 33, 'id' => 'kjfp-tipd', 'parent_id' => 'ka-tipd', 'title' => 'Kelompok Jabatan Fungsional/Pelaksana','subtitle'=>null ],
            [ 'position'=> 34, 'id' => 'ka-bahasa', 'parent_id' => 'rektor', 'title' => 'Kepala UPT Bahasa','subtitle'=>'Unit Penunjang Akademik: Bahasa' ],
            [ 'position'=> 35, 'id' => 'kjf-bahasa', 'parent_id' => 'ka-bahasa', 'title' => 'Kelompok Jabatan Fungsional','subtitle'=>null ],
            [ 'position'=> 36, 'id' => 'kjp-bahasa', 'parent_id' => 'ka-bahasa', 'title' => 'Kelompok Jabatan Pelaksana','subtitle'=>null ],
        ];

        DB::table('job_chart')->insert(array_map(fn($m)=>[
            'position'=>$m['position'],
            'id'=>$m['id'],'parent_id'=>$m['parent_id'],
            'title'=>$m['title'],'subtitle'=>$m['subtitle'],
            'created_at'=>$now,'updated_at'=>$now
        ], $masters));

        // === DETAILS ===
        $details = [
            // kjf-biro-auak
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis SDM Aparatur Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Pengelola Pengadaan Barang/Jasa Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Perencana Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Pengelolaan Keuangan APBN Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Kebijakan Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Anggaran Ahli Madya','kls'=>12,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Pranata Hubungan Masyarakat Ahli Madya','kls'=>11,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Arsiparis Ahli Madya','kls'=>11,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis SDM Aparatur Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Perencana Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Pengelolaan Keuangan APBN Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Kebijakan Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Perancangan Peraturan Perundang-undangan Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-biro-auak','jabatan'=>'Analis Hukum Ahli Muda','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjp-biro-auak
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Pranata Hubungan Masyarakat Ahli Muda','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Pranata Keuangan APBN Penyelia','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Analis SDM Aparatur Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Analis Pengelolaan Keuangan APBN Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Perencana Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Analis Kebijakan Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Perancangan Peraturan Perundang-undangan Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Analis Hukum Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Pranata Hubungan Masyarakat Ahli Muda','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Pranata Keuangan APBN Mahir','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Pranata Keuangan APBN Terampil','kls'=>7,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-biro-auak','jabatan'=>'Penata Kelola Hukum dan Perundang-undangan','kls'=>7,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjf-bag-ula
            [ 'job_chart_id'=>'kjf-bag-ula','jabatan'=>'Arsiparis Ahli Muda','kls'=>9,'b'=>2,'k'=>0,'delta'=>-2 ],
            [ 'job_chart_id'=>'kjf-bag-ula','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>2,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-bag-ula','jabatan'=>'Pranata Komputer Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-bag-ula','jabatan'=>'Analis Hukum','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-bag-ula','jabatan'=>'Pranata Hubungan Masyarakat Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>0 ],
            // kjp-bag-ula
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>2,'k'=>0,'delta'=>-2 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Penata Keprotokolan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Penata Kelola Sistem dan Teknologi Informasi','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Penata Kelola Hukum dan Perundang-undangan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Pengelola Layanan Operasional','kls'=>6,'b'=>1,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-bag-ula','jabatan'=>'Operator Layanan Operasional','kls'=>5,'b'=>3,'k'=>2,'delta'=>-1 ],
            // kjf-dosen
            [ 'job_chart_id'=>'kjf-dosen','jabatan'=>'Dosen Asisten Ahli','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-dosen','jabatan'=>'Dosen Lektor','kls'=>11,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-dosen','jabatan'=>'Dosen Lektor Kepala','kls'=>13,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-dosen','jabatan'=>'Dosen Guru Besar','kls'=>15,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjf-subbag-tu
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pengembang Teknologi Pembelajaran Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Analis Pengelolaan Keuangan APBN Ahli Muda','kls'=>10,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pranata Keuangan APBN Penyelia','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pranata Laboratorium Pendidikan Ahli Muda','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pustakawan Ahli Muda','kls'=>9,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pengembang Teknologi Pembelajaran Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pranata Laboratorium Pendidikan Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Pustakawan Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Perencana Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-subbag-tu','jabatan'=>'Analis SDM Aparatur Ahli Pertama','kls'=>8,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjp-subbag-tu
            [ 'job_chart_id'=>'kjp-subbag-tu','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-subbag-tu','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-subbag-tu','jabatan'=>'Pengadministrasi Perkantoran','kls'=>5,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjf-dosen-pascasarjana
            [ 'job_chart_id'=>'kjf-dosen-pascasarjana','jabatan'=>'Dosen Guru Besar','kls'=>15,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-dosen-pascasarjana','jabatan'=>'Dosen Lektor Kepala','kls'=>13,'b'=>0,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjf-dosen-pascasarjana','jabatan'=>'Dosen Lektor','kls'=>11,'b'=>0,'k'=>0,'delta'=>0 ],
            // kjf-pascasarjana
            [ 'job_chart_id'=>'kjf-pascasarjana','jabatan'=>'Pengembang Teknologi Pembelajaran Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-pascasarjana','jabatan'=>'Pranata Komputer Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-pascasarjana','jabatan'=>'Pranata Laboratorium Pendidikan Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-pascasarjana','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>0 ],
            // kjp-pascasarjana
            [ 'job_chart_id'=>'kjp-pascasarjana','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-pascasarjana','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>3,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-pascasarjana','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-pascasarjana','jabatan'=>'Pengadministrasi Perkantoran','kls'=>5,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjf-spi
            [ 'job_chart_id'=>'kjf-spi','jabatan'=>'Auditor Ahli Muda','kls'=>10,'b'=>2,'k'=>0,'delta'=>-2 ],
            [ 'job_chart_id'=>'kjf-spi','jabatan'=>'Auditor Ahli Pertama','kls'=>8,'b'=>4,'k'=>2,'delta'=>-2 ],
            [ 'job_chart_id'=>'kjf-spi','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjp-spi
            [ 'job_chart_id'=>'kjp-spi','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>2,'k'=>2,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-spi','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjfp-lpm
            [ 'job_chart_id'=>'kjfp-lpm','jabatan'=>'Pengembang Teknologi Pembelajaran Ahli Muda','kls'=>10,'b'=>1,'k'=>1,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-lpm','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>1,'k'=>1,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-lpm','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjp-lpm
            [ 'job_chart_id'=>'kjp-lpm','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-lpm','jabatan'=>'Pengadministrasi Perkantoran','kls'=>5,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjfp-lp2m
            [ 'job_chart_id'=>'kjfp-lp2m','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-lp2m','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjp-lp2m
            [ 'job_chart_id'=>'kjp-lp2m','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>2,'k'=>2,'delta'=>0 ],
            [ 'job_chart_id'=>'kjp-lp2m','jabatan'=>'Pengadministrasi Perkantoran','kls'=>5,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjfp-perpustakaan
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pustakawan Ahli Madya','kls'=>11,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pustakawan Ahli Muda','kls'=>9,'b'=>1,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pustakawan Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pranata Komputer Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>2,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pengembang Buku Elektronik','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Editor Buku','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-perpustakaan','jabatan'=>'Pengolah Data dan Informasia','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjfp-tipd
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Pranata Komputer Ahli Madya','kls'=>11,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Pranata Komputer Ahli Muda','kls'=>9,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Pranata Komputer Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>1,'k'=>0,'delta'=>0 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Penata Kelola Sistem dan Teknologi Informasi','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjfp-tipd','jabatan'=>'Pengolah Data dan Informasia','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjf-bahasa
            [ 'job_chart_id'=>'kjf-bahasa','jabatan'=>'Pranata Laboratorium Pendidikan Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-bahasa','jabatan'=>'Pranata Komputer Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjf-bahasa','jabatan'=>'Arsiparis Ahli Pertama','kls'=>8,'b'=>1,'k'=>0,'delta'=>-1 ],
            // kjp-bahasa
            [ 'job_chart_id'=>'kjp-bahasa','jabatan'=>'Penelaah Teknis Kebijakan','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bahasa','jabatan'=>'Penata Layanan Operasional','kls'=>7,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bahasa','jabatan'=>'Pengolah Data dan Informasi','kls'=>6,'b'=>1,'k'=>0,'delta'=>-1 ],
            [ 'job_chart_id'=>'kjp-bahasa','jabatan'=>'Pengadministrasi Perkantoran','kls'=>5,'b'=>1,'k'=>0,'delta'=>-1 ],
        ];

        DB::table('job_chart_details')->insert(array_map(fn($d)=>array_merge($d,[
            'type'      => null,
            'condition' => null,
            'ref'       => null,
            'created_at'=> $now,
            'updated_at'=> $now,
        ]), $details));
    }
}
