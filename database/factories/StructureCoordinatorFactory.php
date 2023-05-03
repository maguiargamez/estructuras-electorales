<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Position;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StructureCoordinator>
 */
class StructureCoordinatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'structure_id' => Structure::all()->random()->id,
            'position_id' => Position::all()->random()->id,
            'structure_coordinator_id' => null,
            //'member_id' => Member::factory()->create(),
            'goal' => 0
        ];
    }
}
