<?php

namespace Database\Seeders;

use App\Models\ElectionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        ElectionType::insert([
            [
                'description' => 'Estatal',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Municipal',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
