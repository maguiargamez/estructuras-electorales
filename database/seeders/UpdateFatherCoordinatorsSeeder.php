<?php

namespace Database\Seeders;

use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateFatherCoordinatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stateCoordinators= StructureCoordinator::where('position_id',1)->where('election_id', 1)->get();

        foreach($stateCoordinators as $stateCoordinator){

            $distritalCoordinators= StructureCoordinator::
            where('position_id',2)
            ->where('election_id', 1)
            ->get();

            foreach($distritalCoordinators as $distritalCoordinator){
                $coordinator= StructureCoordinator::find($distritalCoordinator->id);
                $coordinator->structure_coordinator_id= $stateCoordinator->id;
                $coordinator->save();

                $municipalityCoordinators= StructureCoordinator::
                where('entity_key', $stateCoordinator->entity_key)
                ->where('local_district', $distritalCoordinator->local_district)
                ->where('position_id',3)
                ->where('election_id', 1)
                ->get();
                
                foreach($municipalityCoordinators as $municipalityCoordinator){
                    $coordinator= StructureCoordinator::find($municipalityCoordinator->id);
                    $coordinator->structure_coordinator_id= $distritalCoordinator->id;
                    $coordinator->save();

                    $sectionCoordinators= StructureCoordinator::
                    where('entity_key', $stateCoordinator->entity_key)
                    ->where('local_district', $distritalCoordinator->local_district)
                    ->where('municipality_key', $municipalityCoordinator->municipality_key)
                    ->where('position_id',5)
                    ->where('election_id', 1)
                    ->get();

                    foreach($sectionCoordinators as $sectionCoordinator){
                        $coordinator= StructureCoordinator::find($sectionCoordinator->id);
                        $coordinator->structure_coordinator_id= $municipalityCoordinator->id;
                        $coordinator->save();
                    }
                }
            }

        }
    }
}
