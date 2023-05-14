<?php

namespace App\Http\Livewire\ElectoralStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use App\Models\Structure;

class ElectoralSectionsStructures extends Component
{
    use WithPagination, WithSorting;
    public $title = 'Estructura electoral';

    public $sections=[];
    public $structure;
    public $promotedNumber;
    public $electionGoal;
    public $percentageCompletion;
    public $totalPromoteds;
    public $totalGoal;


    public $breadcrumb = [
        "Inicio" => "estructura.index",
        "Secciones" => null,
    ];


    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function resetVars()
    {
        $this->resetExcept();
        $this->resetPage();
        //$this->resetFiltros();
    }

    public function mount($structureId)
    {
        $this->structure= Structure::find($structureId);

        $structures= Structure::selectRaw('id, municipality_key, municipality as name, SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$this->structure->election_id.' and st.local_district='.$this->structure->local_district.' and st.municipality_key= `structures`.municipality_key ) as promoteds')->where('election_id', $this->structure->election_id)->where('local_district', $this->structure->local_district)->where('municipality_key', $this->structure->municipality_key)->groupBy('municipality_key')->first();

        $this->totalPromoteds= $structures->promoteds;
        $this->totalGoal= $structures->totalGoal;
        $this->percentageCompletion= number_format((($structures->promoteds*100)/$structures->totalGoal),2);
    }

    public function render()
    {        
        return view('livewire.electoral-structures.sections', [
            'items' => $this->items
        ]);
    }

    public function updatingPaginate()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getItemsQueryProperty()
    {
        $items= [];
        $election= Election::find($this->structure->election_id);
        

            $zones = Structure::selectRaw('
            zone as name, 
            SUM(goal) as totalGoal, 
            (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$this->structure->election_id.' and st.local_district='.$this->structure->local_district.' and st.municipality_key= '.$this->structure->municipality_key.' and zone is not null and st.zone= `structures`.zone ) as promoteds    
            ')
            ->where('election_id', $this->structure->election_id)
            ->where('local_district', $this->structure->local_district)
            ->where('municipality_key', $this->structure->municipality_key)
            ->whereNotNull('zone')
            ->groupBy('zone_key')
            ->get();

            if(count($zones)>0){

                foreach($zones as $zone){
                    $sections= Structure::selectRaw('
                    id,
                    section as name, 
                    SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$this->structure->election_id.' and st.local_district='.$this->structure->local_district.' and st.municipality_key= '.$this->structure->municipality_key.' and st.zone_key= '.$zone->zone_key.' and st.section= `structures`.section ) as promoteds
                    ')
                    ->where('election_id', $this->structure->election_id)
                    ->where('local_district', $this->structure->local_district)
                    ->where('municipality_key', $this->structure->municipality_key)
                    ->where('zone_key', $zone->zone_key)
                    ->groupBy('section')
                    ->get();  
                    
                    array_push(
                        $items, 
                        $this->getArray(
                            $zone->id,
                            $zone->name,
                            $zone->totalGoal,
                            $zone->promoteds,
                            $sections
                        )
                    );
                }                
            }else{
                
                $sections= Structure::selectRaw('
                section as name, 
                SUM(goal) as totalGoal, (select count(*) from structure_promoteds join `structures` as st on st.id= structure_promoteds.structure_id where st.election_id= '.$this->structure->election_id.' and st.local_district='.$this->structure->local_district.' and st.municipality_key= '.$this->structure->municipality_key.' and st.section= `structures`.section ) as promoteds
                ')
                ->where('election_id', $this->structure->election_id)
                ->where('local_district', $this->structure->local_district)
                ->where('municipality_key', $this->structure->municipality_key)
                ->groupBy('section')
                ->get(); 

                foreach($sections as $section){
                    array_push(
                        $items, 
                        $this->getArray(
                            $section->name,
                            $section->totalGoal,
                            $section->promoteds
                        )
                    );
                }

            }   

        

        return $items;
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery);
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
