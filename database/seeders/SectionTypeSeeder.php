<?php

namespace Database\Seeders;

use App\Models\SectionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        SectionType::insert([
            [
                'description' => 'Rural',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Urbano(a)',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Mixto(a)',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
