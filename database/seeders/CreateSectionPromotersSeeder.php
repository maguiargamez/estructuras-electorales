<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSectionPromotersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electionId= 1;
        $municipalityCoordinators= StructureCoordinator::where('election_id', $electionId)->where('position_id',3)->get();

        foreach($municipalityCoordinators as $municipalityCoordinator){

            $sections= Structure::where('entity_key', $municipalityCoordinator->entity_key)->where('election_id', $electionId)->where('local_district', $municipalityCoordinator->local_district)->get();

            foreach($sections as $section){
                $goal = $section->goal;

                if($goal<3){
                    $promoterNumber= 1;
                    $promotersGoal= $goal;
                }else{
                    $promoterNumber= mt_rand(1, 2);
                    $promotersGoal= ceil($goal/$promoterNumber);
                }
    
                Member::factory( $promoterNumber )
                ->has(
                    StructureCoordinator::factory()
                    ->state(function (array $attributes, Member $member) use ($section, $promotersGoal, $municipalityCoordinator, $electionId) {
                        return [
                            'election_id'=> $electionId,
                            'position_id'=>5,
                            'structure_coordinator_id'=> $municipalityCoordinator->id,
                            'member_id' => $member->id,
                            'entity_key' => $section->entity_key,
                            'entity'=> $section->entity,                                
                            'local_district'=> $section->local_district,                                
                            'municipality_key'=> $section->municipality_key,                                
                            'municipality'=> $section->municipality,                                
                            'section'=> $section->section,                               
                            'goal'=>$promotersGoal, 
                        ];
                    })
                    , 'structureCoordinators'
                )
                ->create([
                    'position_id'=>5,
                    'section'=>$section,
                    'section_type' => $section->section_type
                ]);

            }




        }
    }
}
