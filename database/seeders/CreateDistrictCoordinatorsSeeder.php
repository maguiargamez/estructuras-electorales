<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDistrictCoordinatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electionId= 1;
        $stateCoordinators= StructureCoordinator::where('election_id', $electionId)->where('position_id',1)->get();

        foreach($stateCoordinators as $stateCoordinator){

            $districts= Structure::where('entity_key', $stateCoordinator->entity_key)->where('election_id', $electionId)->groupBy('local_district')->get();

            foreach($districts as $district){
                Member::factory()
                ->has(
                    StructureCoordinator::factory()
                    ->state(function (array $attributes, Member $member) use ($electionId, $district, $stateCoordinator) {
                        return [
                            'election_id'=> $electionId,
                            'position_id'=>2,
                            'structure_coordinator_id'=> $stateCoordinator->id,
                            'member_id' => $member->id,
                            'entity_key' => $district->entity_key,
                            'entity'=> $district->entity,                                
                            'local_district'=> $district->local_district,                              
                            'goal'=>0, 
                        ];
                    })
                    , 'structureCoordinators'
                )
                ->create([
                    'position_id'=>2,
                    'section'=>$district->section,
                    'section_type' => $district->section_type
                ]);
            }
        }
    }
}
