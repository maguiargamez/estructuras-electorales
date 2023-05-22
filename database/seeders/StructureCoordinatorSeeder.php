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

            $stateCoordinators= StructureCoordinator::where('election_id', $electionId)->where('position_id',1)->get();

            foreach($stateCoordinators as $stateCoordinator){

                $districts= Structure::where('entity_key', $state->entity_key)->where('election_id', $electionId)->groupBy('local_district')->get();
                foreach($districts as $district){
                    Member::factory()
                    ->has(
                        StructureCoordinator::factory()
                        ->state(function (array $attributes, Member $member) use ($electionId, $state, $stateCoordinator) {
                            return [
                                'election_id'=> $electionId,
                                'position_id'=>2,
                                'structure_coordinator_id'=> $stateCoordinator->id,
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
                        'position_id'=>2,
                        'section'=>$state->section,
                        'section_type' => $state->section_type
                    ]);
                }

                $districtCoordinators= StructureCoordinator::where('election_id', $electionId)->where('position_id',2)->get();
                foreach($districtCoordinators as $districtCoordinator){
                    $municipalities= Structure::where('entity_key', $state->entity_key)->where('election_id', $electionId)->where('local_district', $districtCoordinator->local_district)->groupBy('municipality_key')->groupBy('local_district')->get();

                    foreach($municipalities as $municipality){
                        Member::factory()
                        ->has(
                            StructureCoordinator::factory()
                            ->state(function (array $attributes, Member $member) use ($electionId, $municipality, $districtCoordinator) {
                                return [
                                    'election_id'=> $electionId,
                                    'position_id'=>3,
                                    'structure_coordinator_id'=> $districtCoordinator->id,
                                    'member_id' => $member->id,
                                    'entity_key' => $municipality->entity_key,
                                    'entity'=> $municipality->entity,                                
                                    'local_district'=> $municipality->local_district,                                
                                    'municipality_key'=> $municipality->municipality_key,                                
                                    'municipality'=> $municipality->municipality,                                
                                    'goal'=>0, 
                                ];
                            })
                            , 'structureCoordinators'
                        )
                        ->create([
                            'position_id'=>3,
                            'section'=>$municipality->section,
                            'section_type' => $municipality->section_type
                        ]);
                    }

                }

            }


            




        }



    }
}
