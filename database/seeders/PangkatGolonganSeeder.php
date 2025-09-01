<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatGolonganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pangkat_golongan')->insert([
            ['pangkat' => 'Pembina Utama',        'golongan' => 'IV',  'ruang' => 'e',   'combined' => 'IV.e'],
            ['pangkat' => 'Pembina Utama Madya',  'golongan' => 'IV',  'ruang' => 'd',   'combined' => 'IV.d'],
            ['pangkat' => 'Pembina Utama Muda',   'golongan' => 'IV',  'ruang' => 'c',   'combined' => 'IV.c'],
            ['pangkat' => 'Pembina Tk. I',        'golongan' => 'IV',  'ruang' => 'b',   'combined' => 'IV.b'],
            ['pangkat' => 'Pembina',              'golongan' => 'IV',  'ruang' => 'a',   'combined' => 'IV.a'],
            ['pangkat' => 'Penata Tk. I',         'golongan' => 'III', 'ruang' => 'd',   'combined' => 'III.d'],
            ['pangkat' => 'Penata',               'golongan' => 'III', 'ruang' => 'c',   'combined' => 'III.c'],
            ['pangkat' => 'Penata Muda Tk. I',    'golongan' => 'III', 'ruang' => 'b',   'combined' => 'III.b'],
            ['pangkat' => 'Penata Muda',          'golongan' => 'III', 'ruang' => 'a',   'combined' => 'III.a'],
            ['pangkat' => 'Pengatur Tk. I',       'golongan' => 'II',  'ruang' => 'd',   'combined' => 'II.d'],
            ['pangkat' => 'Pengatur',             'golongan' => 'II',  'ruang' => 'c',   'combined' => 'II.c'],
            ['pangkat' => 'Pengatur Muda Tk. I',  'golongan' => 'II',  'ruang' => 'b',   'combined' => 'II.b'],
            ['pangkat' => 'X',                    'golongan' => 'X',   'ruang' => '',    'combined' => 'X'],
            ['pangkat' => 'IX',                   'golongan' => 'IX',  'ruang' => '',    'combined' => 'IX'],
            ['pangkat' => 'XI',                   'golongan' => 'XI',  'ruang' => '',    'combined' => 'XI'],
            ['pangkat' => 'XII',                  'golongan' => 'XII', 'ruang' => '',    'combined' => 'XII'],
            ['pangkat' => 'V',                    'golongan' => 'V',   'ruang' => '',    'combined' => 'V'],
            ['pangkat' => 'VI',                   'golongan' => 'VI',  'ruang' => '',    'combined' => 'VI'],
            ['pangkat' => 'VII',                  'golongan' => 'VII', 'ruang' => '',    'combined' => 'VII'],
        ]);

    }
}
