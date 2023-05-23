<?php

namespace App\Http\Livewire\PromotedsStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use App\Models\StructurePromoted;

class PromotedsStructures extends Component
{
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Promovidos';
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;
    public $electionGoal;
    public $promotedNumber;
    public $promotedMales=0;
    public $promotedFemales=0;

    public $breadcrumb = [
        "Inicio" => null
    ];

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.promoteds-structure.index',[            
            'items'=> $this->items
        ]);
    }

    public function resetVars()
    {
        $this->resetExcept();
        $this->resetPage();
        //$this->resetFiltros();
    }

    public function mountWithSorting()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }

    public function mount()
    {        
        $this->resetVars();
        $this->electionGoal= Structure::where('election_id', $this->electionId)->sum('goal');
        $this->promotedNumber= StructurePromoted::with('structure')->whereHas('structure', function($query){
            $query->where('election_id', $this->electionId);
        })->count();

        $promoteds= StructurePromoted::gender($this->electionId)->get();
        $this->promotedMales= $promoteds[0]->total;
        $this->promotedFemales= $promoteds[1]->total;        
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
        return StructurePromoted::list($this->electionId)
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }


}
