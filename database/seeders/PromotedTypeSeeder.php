<?php

namespace Database\Seeders;

use App\Models\PromotedType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotedTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate= date('Y-m-d h:m:s');
        PromotedType::insert([
            [
                'description' => 'Simpatizante',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'No simpatizante',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'description' => 'Indeciso/No definido',
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ]);
    }
}
