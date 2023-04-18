<?php

namespace Database\Seeders;

use App\Models\SchoolGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        SchoolGrade::insert([
            [
                'description' => 'Primaria',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Secundaria',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Bachillerato',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Carrera técnica o comercial',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Licenciatura',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Especialidad',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Maestría',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Doctorado',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
