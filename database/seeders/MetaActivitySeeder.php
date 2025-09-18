<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetaActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meta_activity')->insert([
            [
                'name'         => 'pegawai',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'logs',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'roles',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'role_permissions',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'users',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'user_groups',
                'last_activity'=> Carbon::now(),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
