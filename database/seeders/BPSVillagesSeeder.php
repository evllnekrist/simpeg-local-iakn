<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Seeds\CsvtoArray;

class BPSVillagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/villages.csv';
        $header = ['id', 'code', 'bps_code', 'name', 'district_code'];
        $data = $csv->csv_to_array($file, $header);

        $data = array_map(function ($arr) use ($now) {
            $arr['code'] = str_replace('.', '', $arr['code']);
            $arr['bps_code'] = str_replace('.0', '', $arr['bps_code']);
            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);


        foreach ($data as $itemData) {
            if (empty($itemData['code']) || empty($itemData['bps_code']) || ($itemData['code'] != 'NULL') || ($itemData['bps_code'] != '#VALUE!')) {
                continue;
            }
            Village::updateOrCreate(['code' => $itemData['code']], ['district_code' => $itemData['district_code'], 'bps_code' => $itemData['bps_code'], 'name' => $itemData['name']]);
        }
    }
}