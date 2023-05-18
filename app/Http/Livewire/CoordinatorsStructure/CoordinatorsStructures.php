<?php

namespace App\Http\Livewire\CoordinatorsStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\StructureCoordinator;

class CoordinatorsStructures extends Component
{
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Coordinadores';
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;

    public $breadcrumb = [
        "Inicio" => null
    ];


    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.coordinators-structure.index',[
            'dashboards'=> $this->dashboards,
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
        return StructureCoordinator::query()
            ->with('member')
            ->with('position')
            ->where('election_id', $this->electionId)
            ->whereIn('position_id', [1,2,3,4])
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function getDashboardsQueryProperty()
    {
        return StructureCoordinator::query()
            ->with('member')
            ->with('position')
            ->where('election_id', $this->electionId)
            ->whereIn('position_id', [1,2,3,4])
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getDashboardsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }


}
