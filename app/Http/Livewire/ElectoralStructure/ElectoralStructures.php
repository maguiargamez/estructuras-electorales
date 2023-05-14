<?php

namespace App\Http\Livewire\ElectoralStructure;

use App\Http\Classes\Helper;
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
        $this->resetPage();
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

        $districts= Structure::selectRaw('
        id,
        local_district, 
        SUM(goal) as totalGoal, 
        (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district= `structures`.local_district ) as promoteds

        ')->where('election_id', $election_id)->groupBy('local_district')->get(); 

        $array= [];

        foreach($districts as $district){
            $municipalities= Structure::selectRaw('id, municipality_key, municipality as name, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.local_district='.$district->local_district.' and st.municipality_key= `structures`.municipality_key ) as promoteds')->where('election_id', $election_id)->where('local_district', $district->local_district)->groupBy('municipality_key')->get();  
            
            array_push(
                $array, 
                $this->getArray(
                    'Distrito '.Helper::toRomanNumeral($district->local_district),
                    $district->totalGoal,
                    $district->promoteds,
                    $municipalities
                )
            );
        }

        return $array;
    }

    private function getMunicipalityStructure($election_id){

        $municipalities= Structure::selectRaw('
        municipality_key, 
        municipality as name,         
        SUM(goal) as totalGoal, 
        (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.municipality_key= `structures`.municipality_key ) as promoteds

        ')->where('election_id', $election_id)->groupBy('municipality_key')->get(); 

        $array= [];

        foreach($municipalities as $municipality){
            $districts= Structure::selectRaw('
            id,
            local_district as name, 
            SUM(goal) as totalGoal, 
            (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$election_id.' and st.municipality_key='.$municipality->municipality_key.' and st.local_district= `structures`.local_district ) as promoteds
            ')->where('election_id', $election_id)->where('municipality_key', $municipality->municipality_key)->groupBy('local_district')->get(); 
            
            foreach($districts as $district){
                $district->name= 'Distrito '.Helper::toRomanNumeral($district->name);
            }
            
            array_push(
                $array, 
                $this->getArray(
                    $municipality->name,
                    $municipality->totalGoal,
                    $municipality->promoteds,
                    $districts
                )
            );
        }

        return $array;
    }




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
