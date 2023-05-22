<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateMunicipalityCoordinatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electionId= 1;
        $districtCoordinators= StructureCoordinator::where('election_id', $electionId)->where('position_id',2)->get();

        foreach($districtCoordinators as $districtCoordinator){
            $municipalities= Structure::where('entity_key', $districtCoordinator->entity_key)->where('election_id', $electionId)->where('local_district', $districtCoordinator->local_district)->groupBy('municipality_key')->groupBy('local_district')->get();

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
