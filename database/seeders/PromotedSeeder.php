<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use App\Models\StructurePromoted;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electionId= 1;
        //$promoters= StructureCoordinator::where('election_id', $electionId)->where('position_id',5)->get();
        $sections= Structure::where('election_id', $electionId)->get();

        foreach($sections as $section){

            $goal= $section->goal;
            $promoters= StructureCoordinator::where('election_id', $electionId)->where('position_id',5)->where('section', $section->section)->get();            

            foreach($promoters as $promoter){
                $promotedsNumber= mt_rand(1, $promoter->goal);
                Member::factory($promotedsNumber)
                ->has(
                    StructurePromoted::factory()
                    ->state(function (array $attributes, Member $member) use ($section, $promoter) {
                        return [
                            'structure_id'=> $section->id,
                            'structure_coordinator_id'=> $promoter->id,
                            'member_id' => $member->id,
                        ];
                    })
                    , 'structurePromoteds'
                )
                ->create([
                    'position_id'=>6,
                    'section'=>$section->section,
                    'section_type' => $section->section_type
                ]);
            }

        }

    }
}
