<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Seeds\CsvtoArray;

class BPSProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvtoArray();
        $file = __DIR__.'/../../resources/csv/provinces.csv';
        $header = ['id', 'code', 'bps_code', 'name'];
        $data = $csv->csv_to_array($file, $header);

        $data = array_map(function ($arr) use ($now) {
            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        foreach ($data as $itemData) {
            $this->updateOrCreateProvince($itemData['code'], ['bps_code' => $itemData['bps_code'], 'name' => $itemData['name']]);
        }
    }

    /**
     * Update or create a province with the provided data.
     *
     * @param string $code
     * @param array $data
     */
    private function updateOrCreateProvince(string $code, array $data): void
    {
        Province::updateOrCreate(['code' => $code], $data);
    }
}