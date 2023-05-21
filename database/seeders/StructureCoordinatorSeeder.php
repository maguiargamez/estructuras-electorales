<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
class StructureCoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states= Structure::where('election_id', 1)->groupBy('entity_key')->get();

        foreach($states as $state){

            Member::factory()
            ->has(
                StructureCoordinator::factory()
                ->state(function (array $attributes, Member $member) use ($state) {
                    return [
                        'election_id'=> 1,
                        'position_id'=>1,
                        'structure_coordinator_id'=> null,
                        'member_id' => $member->id,
                        'entity_key' => $state->entity_key,
                        'entity'=> $state->entity,                                
                        'local_district'=> $state->local_district,                                
                        'municipality_key'=> $state->municipality_key,                                
                        'municipality'=> $state->municipality,                                
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


            $districts= Structure::where('entity_key', $state->entity_key)->where('election_id', 1)->groupBy('local_district')->get();

            foreach($districts as $district){
                Member::factory()
                ->has(
                    StructureCoordinator::factory()
                    ->state(function (array $attributes, Member $member) use ($state) {
                        return [
                            'election_id'=> 1,
                            'position_id'=>2,
                            'structure_coordinator_id'=> ,
                            'member_id' => $member->id,
                            'entity_key' => $state->entity_key,
                            'entity'=> $state->entity,                                
                            'local_district'=> $state->local_district,                                
                            'municipality_key'=> $state->municipality_key,                                
                            'municipality'=> $state->municipality,                                
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
}
