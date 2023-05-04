<?php

namespace Database\Factories;

use App\Models\Election;
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
            'election_id'=> Election::all()->random()->id,
            'position_id' => Position::all()->random()->id,
            'structure_coordinator_id' => null,
            //'member_id' => Member::factory()->create(),
            'entity_key'=> 7,
            'entity'=> 'Chiapas',
            'federal_district'=> null,            
            'local_district'=> null,
            'municipality_key'=> null,
            'municipality'=> null,
            'zone_key'=> null,
            'zone'=> null,
            'section'=> null,
            'goal'=> 0,
        ];
    }
}
