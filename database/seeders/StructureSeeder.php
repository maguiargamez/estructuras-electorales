<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Structure::truncate();
        $csvData = fopen(base_path('database/csv/structures.csv'), 'r');
        $titleRow = true;
        $currentDate= date('Y-m-d h:m:s');
        //$finalGoal= 2000000;

        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$titleRow) {

                $time = strtotime(trim($data['1']));
                $newformat = date('Y-m-d',$time);

                $goal = mt_rand(1,2000);
                //$finalGoal= $finalGoal-$goal;

                Structure::create([
                    'election_id'=>1,
                    'entity_key' => Str::title(strtolower(trim($data['0']))),
                    'entity' => 'Chiapas',
                    'federal_district' => Str::title(strtolower(trim($data['1']))),
                    'local_district' => Str::title(strtolower(trim($data['2']))),
                    'municipality_key' => Str::title(strtolower(trim($data['3']))),
                    'municipality' => Str::title(strtolower(trim($data['4']))),
                    'zone_key' => null,
                    'zone' => null,
                    'section' => Str::title(strtolower(trim($data['5']))),
                    'section_type_key' => Str::title(strtolower(trim($data['6']))),
                    'section_type' => Str::title(strtolower(trim($data['7']))),
                    'goal' => $goal,
                    'created_at' => $currentDate,
                    'updated_at' => $currentDate,
                ]);
            }
            $titleRow = false;
        }
        fclose($csvData);
    }
}
