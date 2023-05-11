<?php

namespace App\Http\Livewire\ElectoralStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use App\Models\Structure;

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

    }
}
