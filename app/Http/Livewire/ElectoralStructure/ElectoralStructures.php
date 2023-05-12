<?php

namespace App\Http\Livewire\ElectoralStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use App\Models\Structure;
use App\Models\StructurePromoted;
use Illuminate\Support\Str;
class ElectoralStructures extends Component
{
    use WithPagination, WithSorting;
    public $title = 'Estructura electoral';
    public $breadcrumb = [
        "Inicio" => null
    ];

    

    /*public $selectAllItems = false;
    public $selectedItems = [];
    public $paginate = 10;    
    public $search = '';*/
    public $election_id= 1;
    public $election;
    public $electionGoal;
    public $promotedNumber;
    public $structures=[];

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function updatedElectionId()
    {
        $this->resetVars();
        $this->loadData();
        
    }

    public function mount()
    {
        $this->resetVars();
        $this->loadData();      
        
    }

    public function render()
    {
        $elections= Election::pluck('description', 'id');
        return view('livewire.electoral-structures.index', ['elections'=> $elections]);
    }

    public function resetVars()
    {
        $this->resetExcept('election_id');
        $this->resetPage();
        //$this->resetFiltros();
    }

    private function loadData()
    {
        $this->election= Election::with('electionType')->find($this->election_id);
        $this->electionGoal= Structure::where('election_id', $this->election_id)->sum('goal');
        $this->promotedNumber= StructurePromoted::with('structure')->whereHas('structure', function($query){
            $query->where('election_id', $this->election_id);
        })->count();


        $structures= [];
        if($this->election->election_type_id==1){
            $this->structures= $this->getStateStructure($this->election_id);
                       
        }else{
            $this->structures= $this->getMunicipalityStructure($this->election_id);
                        
        }
    }

    private function getStateStructure($election_id){
        $structures= [];
        $districts= Structure::selectRaw('local_district, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district= `structures`.local_district ) as promoteds')->where('election_id', $election_id)->groupBy('local_district')->get();     
            

        foreach($districts as $district){
            $municipalities= Structure::selectRaw('municipality_key, municipality, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district='.$district->local_district.' and st.municipality_key= `structures`.municipality_key ) as promoteds')->where('election_id', $election_id)->where('local_district', $district->local_district)->groupBy('municipality_key')->get();
           

            $arrayMunicipalities= [];
            foreach($municipalities as $municipality){
                $zones= Structure::selectRaw('zone_key, zone, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district='.$district->local_district.' and st.municipality_key= '.$municipality->municipality_key.' and zone is not null and st.zone= `structures`.zone  ) as promoteds')->where('election_id', $election_id)->where('municipality_key', $municipality->municipality_key)->whereNotNull('zone')->groupBy('zone_key')->get();

                

                if(count($zones)>0){

                    $arrayZones= [];
                    foreach($zones as $zone){
                        $sections= Structure::selectRaw('section, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district='.$district->local_district.' and st.municipality_key= '.$municipality->municipality_key.' and st.section= `structures`.section  ) as promoteds')->where('election_id', $election_id)->where('zone_key', $zone->zone_key)->groupBy('section')->get();

                        $arraySections= [];
                        foreach($sections as $section){
                            array_push(
                                $arraySections, 
                                $this->getArray($section->section, $section->totalGoal, $section->promoteds)
                            );
                        }

                        array_push(
                            $arraySections, 
                            $this->getArray($zone->zone, $zone->totalGoal, $zone->promoteds, $arraySections)
                        );

                    }

                    array_push(
                        $arrayMunicipalities, 
                        $this->getArray($municipality->municipality, $municipality->totalGoal, $municipality->promoteds, $zones)
                    );

                }else{
                    $sections= Structure::selectRaw('section, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district='.$district->local_district.' and st.municipality_key= '.$municipality->municipality_key.' and st.section= `structures`.section  ) as promoteds')->where('election_id', $election_id)->where('municipality_key', $municipality->municipality_key)->groupBy('section')->get();
                    
                    

                    $arraySections= [];
                    foreach($sections as $section){

                        array_push(
                            $arraySections, 
                            $this->getArray('Sección '.$section->section, $section->totalGoal, $section->promoteds)
                        );

                    }
                    
                    array_push(
                        $arrayMunicipalities, 
                        $this->getArray($municipality->municipality, $municipality->totalGoal, $municipality->promoteds, $arraySections)
                    );
                }

            }

            array_push(
                $structures, 
                $this->getArray('Distrito '.$district->local_district, $district->totalGoal, $district->promoteds,$arrayMunicipalities)
            );

   
        }

        return $structures;
    }

    /*private function getMunicipalityStructure($election_id){
        $structures= [];
        //$districts= Structure::selectRaw('local_district, SUM(goal) as totalGoal')->groupBy('local_district')->get();         


        $municipalities= Structure::selectRaw('municipality_key, municipality, SUM(goal) as totalGoal')->where('election_id', $election_id)->groupBy('municipality_key')->get();

        $arrayMunicipalities= [];
        foreach($municipalities as $municipality){

            $districts= Structure::selectRaw('local_district, SUM(goal) as totalGoal')->where('election_id', $election_id)->where('municipality_key', $municipality->municipality_key)->groupBy('local_district')->get();

            $arrayDistricts= [];
            foreach($districts as $district)
            {            

                $zones= Structure::selectRaw('zone_key, zone, SUM(goal) as totalGoal')->where('election_id', $election_id)->where('local_district', $district->local_district)->whereNotNull('zone')->groupBy('zone_key')->get();

                if(count($zones)>0){

                    $arrayZones= [];
                    foreach($zones as $zone){
                        $sections= Structure::selectRaw('section, SUM(goal) as totalGoal')->where('election_id', $election_id)->where('zone_key', $zone->zone_key)->groupBy('section')->get();

                        $arraySections= [];
                        foreach($sections as $section){
                            array_push(
                                $arraySections, 
                                $this->getArray($section->section, $section->totalGoal)
                            );
                        }

                        array_push(
                            $arraySections, 
                            $this->getArray($zone->zone, $zone->totalGoal, $arraySections)
                        );

                    }

                    array_push(
                        $arrayDistricts, 
                        $this->getArray($district->local_district, $district->totalGoal, $zones)
                    );

                }else{
                    $sections= Structure::selectRaw('section, SUM(goal) as totalGoal')->where('election_id', $election_id)->where('local_district', $district->local_district)->groupBy('section')->get(); 

                    $arraySections= [];
                    foreach($sections as $section){

                        array_push(
                            $arraySections, 
                            $this->getArray('Sección '.$section->section, $section->totalGoal)
                        );

                    }
                    
                    array_push(
                        $arrayDistricts, 
                        $this->getArray($district->local_district, $district->totalGoal, $arraySections)
                    );
                }

            }

            array_push(
                $structures, 
                $this->getArray($district->local_district, $district->totalGoal, $arrayMunicipalities)
            );


        }

        array_push(
            $structures, 
            $this->getArray($municipality->municipality, $municipality->totalGoal, $arrayDistricts)
        );  
        

        return $structures;
    }*/

    private function getArray($name, $goal, $promoteds, $childrens= null, $id=null){

        $array=[
            'name'=> $name,
            'goal'=> $goal,
            'promoteds'=> $promoteds
        ];

        if($childrens!=null){
            $array['childrens']= $childrens;
        }

        if($childrens!=null){
            $id['id']= $id;
        }
        
        return $array;
    }


}
