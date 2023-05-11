<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        Position::insert([
            [
                'election_type_id' => 1,
                'hierarchy' => 1,
                'description' => 'Coordinador estatal',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 1,
                'hierarchy' => 2,
                'description' => 'Coordinador distrital',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 1,
                'hierarchy' => 3,
                'description' => 'Coordinador municipal',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 1,
                'hierarchy' => 3,
                'description' => 'Coordinador de zona',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 1,
                'hierarchy' => 4,
                'description' => 'Promotor',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 1,
                'hierarchy' => 5,
                'description' => 'Promovido',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'hierarchy' => 1,
                'description' => 'Coordinador municipal',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'hierarchy' => 2,
                'description' => 'Coordinador distrital',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'hierarchy' => 3,
                'description' => 'Coordinador de zona',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'hierarchy' => 4,
                'description' => 'Promotor',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'election_type_id' => 2,
                'hierarchy' => 5,
                'description' => 'Promovido',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ]

        ]);
    }
}
