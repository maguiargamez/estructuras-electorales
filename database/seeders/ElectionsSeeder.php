<?php

namespace Database\Seeders;

use App\Models\Election;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        Election::insert([
            [
                'election_type_id' => 1,
                'state_id' => 7,
                'municipality_id' => null,
                'description' => 'Elección Chiapas 2024',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'state_id' => 7,
                'municipality_id' => 102,
                'description' => 'Elección Tuxtla 2024',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]
        ]);
    }
}
