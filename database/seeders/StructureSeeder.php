<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use App\Models\StructurePromoted;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Structure::truncate();
        $csvData = fopen(base_path('database/csv/structuresFull.csv'), 'r');
        $titleRow = true;
        $currentDate= date('Y-m-d h:m:s');
        //$finalGoal= 2000000;
        $arrayEntityKeys= [];
        $arrayLocalDistricts= [];
        $arrayMunicipalityKeys= [];
        $arrayZoneKeys= [];
        $arraySections= [];

        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$titleRow) {

                $time = strtotime(trim($data['1']));
                $newformat = date('Y-m-d',$time);

                $goal = mt_rand(1,15);
                //$finalGoal= $finalGoal-$goal;
                $entityKey= Str::title(strtolower(trim($data['0'])));
                $entity= 'Chiapas';
                $localDistrict= Str::title(strtolower(trim($data['2'])));
                $municipalityKey= Str::title(strtolower(trim($data['3'])));
                $zoneKey= null;
                $section= Str::title(strtolower(trim($data['5'])));
                $section_type= Str::title(strtolower(trim($data['7'])));

                $arrayStructure= [
                    'election_id'=>1,
                    'entity_key' => $entityKey,
                    'entity' => 'Chiapas',
                    'federal_district' => Str::title(strtolower(trim($data['1']))),
                    'local_district' => $localDistrict,
                    'municipality_key' => $municipalityKey,
                    'municipality' => Str::title(strtolower(trim($data['4']))),
                    'zone_key' => $zoneKey,
                    'zone' => null,
                    'section' => $section,
                    'section_type_key' => Str::title(strtolower(trim($data['6']))),
                    'section_type' => $section_type,
                    'goal' => $goal,
                    'created_at' => $currentDate,
                    'updated_at' => $currentDate,
                ];

                $structure= Structure::create($arrayStructure);
                $structure_id= $structure->id;

                /*
                if(!in_array($entityKey, $arrayEntityKeys)){
                    
                    $array= [
                        'structure_id' => $structure_id,
                        'position_id'=>1,
                        'goal'=>0,
                    ];
                    
                    Member::factory()
                    ->has(
                        StructureCoordinator::factory()
                        ->state(function (array $attributes, Member $member) use ($structure) {
                            return [
                                'election_id'=> 1,
                                'position_id'=>1,
                                'member_id' => $member->id,
                                'entity_key' => $structure['entity_key'],
                                'entity'=> $structure['entity'],                                
                                'goal'=>0,                                
                            ];
                        })
                        , 'structureCoordinators'
                    )
                    ->create([
                        'position_id'=>1,
                        'section'=>$section,
                        'section_type' => $section_type
                    ]);   

                    array_push($arrayEntityKeys, $entityKey);

                }
                */

                /*
                if(!in_array($localDistrict, $arrayLocalDistricts)){

                    Member::factory()
                    ->has(
                        StructureCoordinator::factory()
                        ->state(function (array $attributes, Member $member) use ($structure) {
                            return [
                                'election_id'=> 1,
                                'position_id'=>2,
                                'member_id' => $member->id,
                                'entity_key' => $structure['entity_key'],
                                'entity'=> $structure['entity'],                                
                                'local_district'=> $structure['local_district'],                                
                                'goal'=>0, 
                            ];
                        })
                        , 'structureCoordinators'
                    )
                    ->create([
                        'position_id'=>2,
                        'section'=>$section,
                        'section_type' => $section_type
                    ]);  

                    array_push($arrayLocalDistricts, $localDistrict);
                }
                */

                /*
                if(!in_array($municipalityKey, $arrayMunicipalityKeys)){

                    Member::factory()
                    ->has(
                        StructureCoordinator::factory()
                        ->state(function (array $attributes, Member $member) use ($structure) {
                            return [
                                'election_id'=> 1,
                                'position_id'=>3,
                                'member_id' => $member->id,
                                'entity_key' => $structure['entity_key'],
                                'entity'=> $structure['entity'],                                
                                'local_district'=> $structure['local_district'],                                
                                'municipality_key'=> $structure['municipality_key'],                                
                                'municipality'=> $structure['municipality'],                                
                                'goal'=>0, 
                            ];
                        })
                        , 'structureCoordinators'
                    )
                    ->create([
                        'position_id'=>3,
                        'section'=>$section,
                        'section_type' => $section_type
                    ]);  

                    array_push($arrayMunicipalityKeys, $municipalityKey);
                }
                */

                /*
                if(!in_array($zoneKey, $arrayZoneKeys) && $zoneKey!=null){

                    Member::factory()
                    ->has(
                        StructureCoordinator::factory()
                        ->state(function (array $attributes, Member $member) use ($structure) {
                            return [
                                'election_id'=> 1,
                                'position_id'=>4,
                                'member_id' => $member->id,
                                'entity_key' => $structure['entity_key'],
                                'entity'=> $structure['entity'],                                
                                'local_district'=> $structure['local_district'],                                
                                'municipality_key'=> $structure['municipality_key'],                                
                                'municipality'=> $structure['municipality'],                                
                                'zone_key'=> $structure['zone_key'],                                
                                'zone'=> $structure['zone'],                                
                                'goal'=>0, 
                            ];
                        })
                        , 'structureCoordinators'
                    )
                    ->create([
                        'position_id'=>4,
                        'section'=>$section,
                        'section_type' => $section_type
                    ]);  

                    array_push($arrayZoneKeys, $zoneKey);
                }
                */
                /*
                if(!in_array($section, $arraySections)){


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
                        ->state(function (array $attributes, Member $member) use ($structure, $promotersGoal) {
                            return [
                                'election_id'=> 1,
                                'position_id'=>5,
                                'member_id' => $member->id,
                                'entity_key' => $structure['entity_key'],
                                'entity'=> $structure['entity'],                                
                                'local_district'=> $structure['local_district'],                                
                                'municipality_key'=> $structure['municipality_key'],                                
                                'municipality'=> $structure['municipality'],                                
                                'zone_key'=> $structure['zone_key'],                                
                                'zone'=> $structure['zone'],                                
                                'section'=> $structure['section'],                               
                                'goal'=>$promotersGoal, 
                            ];
                        })
                        , 'structureCoordinators'
                    )
                    ->create([
                        'position_id'=>5,
                        'section'=>$section,
                        'section_type' => $section_type
                    ]);  

                    $promoters= StructureCoordinator::where('position_id', 5)->where('section', $structure['section'])->get();
                    $promotedsNumber= mt_rand(1,$promotersGoal);   

                    foreach($promoters as $promoter){
                        Member::factory($promotedsNumber)
                        ->has(
                            StructurePromoted::factory()
                            ->state(function (array $attributes, Member $member) use ($structure, $promoter) {
                                return [
                                    'structure_id'=> $structure->id,
                                    'structure_coordinator_id'=> $promoter,
                                    'member_id' => $member->id,
                                ];
                            })
                            , 'structurePromoteds'
                        )
                        ->create([
                            'position_id'=>6,
                            'section'=>$section,
                            'section_type' => $section_type
                        ]);
                    }                    

                    array_push($arraySections, $section);
                }
                */
                

                             
            }
            $titleRow = false;
        }
        fclose($csvData);
    }
}
