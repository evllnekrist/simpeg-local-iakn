<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Seeds\CsvtoArray;

class BPSCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/regencies.csv';
        $header = ['id', 'code', 'bps_code', 'name', 'province_code', 'correction_formula', 'original_code'];
        $data = $csv->csv_to_array($file, $header);

        $data = array_map(function ($arr) use ($now) {
            $arr['code'] = str_replace('.', '', $arr['code']);
            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        foreach ($data as $itemData) {
            $this->updateOrCreateCity($itemData['code'], ['province_code' => $itemData['province_code'], 'bps_code' => $itemData['bps_code'], 'name' => $itemData['name']]);
        }
    }

    /**
     * Update or create a city with the provided data.
     *
     * @param string $code
     * @param array $data
     */
    private function updateOrCreateCity(string $code, array $data): void
    {
        City::updateOrCreate(['code' => $code], $data);
    }
}