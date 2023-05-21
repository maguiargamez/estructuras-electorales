<?php

namespace Database\Seeders;

use App\Models\StructureCoordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UpdateGoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$state= StructureCoordinator::where('position_id',1)->where('election_id', 1)->get();

        $zoneCoordinators= StructureCoordinator::where('position_id',4)->where('election_id', 1)->get();
        
        if(count($zoneCoordinators)>0){
            foreach($zoneCoordinators as $zoneCoordinator){
                $promoters= StructureCoordinator::select(
                    DB::raw('sum(goal) as total')    
                )
                ->where('structure_coordinator_id', $zoneCoordinator->id)
                ->where('position_id',5)
                ->where('election_id', 1)
                ->first();

                $coordinator= StructureCoordinator::find($zoneCoordinator->id);
                $coordinator->goal= $promoters->total;
                $coordinator->save();
            }
            //Aqui actualizamos los municipales pendiente
        }else{
            
            $municipalityCoordinators= StructureCoordinator::where('position_id',3)->where('election_id', 1)->get();
            foreach($municipalityCoordinators as $municipalityCoordinator){
                $promoters= StructureCoordinator::select(
                    DB::raw('sum(goal) as total')    
                )
                ->where('structure_coordinator_id', $municipalityCoordinator->id)
                ->where('position_id',5)
                ->where('election_id', 1)
                ->first();

                //dd($promoters);
                $coordinator= StructureCoordinator::find($municipalityCoordinator->id);
                $coordinator->goal= $promoters->total;
                $coordinator->save();
            }

            $distritalCoordinators= StructureCoordinator::where('position_id',2)->where('election_id', 1)->get();
            foreach($distritalCoordinators as $distritalCoordinator){
                $promoters= StructureCoordinator::select(
                    DB::raw('sum(goal) as total')    
                )
                ->where('structure_coordinator_id', $distritalCoordinator->id)
                ->where('position_id',3)
                ->where('election_id', 1)
                ->first();
    
                $coordinator= StructureCoordinator::find($distritalCoordinator->id);
                $coordinator->goal= $promoters->total;
                $coordinator->save();
            }
    
            $stateCoordinators= StructureCoordinator::where('position_id',1)->where('election_id', 1)->get();
            foreach($stateCoordinators as $stateCoordinator){
                $promoters= StructureCoordinator::select(
                    DB::raw('sum(goal) as total')    
                )
                ->where('structure_coordinator_id', $stateCoordinator->id)
                ->where('position_id',2)
                ->where('election_id', 1)
                ->first();
    
                $coordinator= StructureCoordinator::find($stateCoordinator->id);
                $coordinator->goal= $promoters->total;
                $coordinator->save();
            }
        }





    }
}
