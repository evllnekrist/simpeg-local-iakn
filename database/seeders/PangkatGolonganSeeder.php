<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatGolonganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pangkat_golongan')->insert([
            ['pangkat' => 'Pembina Utama', 'golongan' => 'IV', 'ruang' => 'e'],
            ['pangkat' => 'Pembina Utama Madya', 'golongan' => 'IV', 'ruang' => 'd'],
            ['pangkat' => 'Pembina Utama Muda', 'golongan' => 'IV', 'ruang' => 'c'],
            ['pangkat' => 'Pembina Tk. I', 'golongan' => 'IV', 'ruang' => 'b'],
            ['pangkat' => 'Pembina', 'golongan' => 'IV', 'ruang' => 'a'],
            ['pangkat' => 'Penata Tk. I', 'golongan' => 'III', 'ruang' => 'd'],
            ['pangkat' => 'Penata', 'golongan' => 'III', 'ruang' => 'c'],
            ['pangkat' => 'Penata Muda Tk. I', 'golongan' => 'III', 'ruang' => 'b'],
            ['pangkat' => 'Penata Muda', 'golongan' => 'III', 'ruang' => 'a'],
            ['pangkat' => 'Pengatur Tk. I', 'golongan' => 'II', 'ruang' => 'd'],
            ['pangkat' => 'Pengatur', 'golongan' => 'II', 'ruang' => 'c'],
            ['pangkat' => 'Pengatur Muda Tk. I', 'golongan' => 'II', 'ruang' => 'b'],
            ['pangkat' => 'X', 'golongan' => 'X', 'ruang' => 'X'],
            ['pangkat' => 'IX', 'golongan' => 'IX', 'ruang' => 'IX'],
            ['pangkat' => 'XI', 'golongan' => 'XI', 'ruang' => 'XI'],
            ['pangkat' => 'XII', 'golongan' => 'XII', 'ruang' => 'XII'],
            ['pangkat' => 'V', 'golongan' => 'V', 'ruang' => 'V'],
            ['pangkat' => 'VI', 'golongan' => 'VI', 'ruang' => 'VI'],
            ['pangkat' => 'VII', 'golongan' => 'VII', 'ruang' => 'VII'],
        ]);
    }
}
