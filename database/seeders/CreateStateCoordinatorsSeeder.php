<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateStateCoordinatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electionId= 1;
        $states= Structure::where('election_id', 1)->groupBy('entity_key')->get();
        foreach($states as $state){

            Member::factory()
            ->has(
                StructureCoordinator::factory()
                ->state(function (array $attributes, Member $member) use ($electionId, $state) {
                    return [
                        'election_id'=> $electionId,
                        'position_id'=>1,
                        'structure_coordinator_id'=> null,
                        'member_id' => $member->id,
                        'entity_key' => $state->entity_key,
                        'entity'=> $state->entity,                               
                              
                        'goal'=>0, 
                    ];
                })
                , 'structureCoordinators'
            )
            ->create([
                'position_id'=>1,
                'section'=>$state->section,
                'section_type' => $state->section_type
            ]);
        }
    }
}
