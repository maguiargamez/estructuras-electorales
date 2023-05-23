<?php

namespace Database\Factories;

use App\Models\PromotedType;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StructurePromoted>
 */
class StructurePromotedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'structure_id'=> Structure::all()->random()->id,
            //'structure_coordinator_id' => StructureCoordinator::all()->random()->id,
            //'member_id' => Member::factory()->create(),
            //'confirmation' => $this->faker->boolean,
            'promoted_type_id' => PromotedType::all()->random()->id,

  
        ];
    }
}
