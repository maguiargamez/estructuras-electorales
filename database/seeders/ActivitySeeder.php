<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Activity::truncate();
        $csvData = fopen(base_path('database/csv/activities.csv'), 'r');
        $titleRow = true;
        $currentDate= date('Y-m-d h:m:s');
        
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$titleRow) {

                $time = strtotime(trim($data['1']));
                $newformat = date('Y-m-d',$time);

                Activity::create([
                    'description' => Str::title(strtolower(trim($data['1']))),
                    'created_at' => $currentDate,
                    'updated_at' => $currentDate,
                ]);
            }
            $titleRow = false;
        }
        fclose($csvData);
    }

    /*public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        Activity::insert([
            [
                'description' => 'Profesionista',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Técnico',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Trabajador de la educación',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Trabajador del arte',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Funcionario público',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Artesano',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }*/
}
