<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipality::truncate();
        $csvData = fopen(base_path('database/csv/municipios.csv'), 'r');
        $titleRow = true;
        $currentDate= date('Y-m-d h:m:s');
        
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$titleRow) {

                $time = strtotime(trim($data['1']));
                $newformat = date('Y-m-d',$time);

                Municipality::create([
                    'state_id' => 7,
                    'local_district' => Str::title(strtolower(trim($data['2']))),
                    'federal_district' => Str::title(strtolower(trim($data['1']))),
                    'key' => Str::title(strtolower(trim($data['3']))),
                    'description' => Str::title(strtolower(trim($data['4']))),
                    'created_at' => $currentDate,
                    'updated_at' => $currentDate,
                ]);
            }
            $titleRow = false;
        }
        fclose($csvData);
    }
}
