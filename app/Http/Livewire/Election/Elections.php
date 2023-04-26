<?php

namespace App\Http\Livewire\Election;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\Election;
use App\Models\ElectionType;
use Livewire\WithPagination;

class Elections extends Component
{
    use WithPagination, WithSorting;
    public $selectAllItems = false;
    public $selectedItems = [];
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;    
    public $search = '';
    public $modelId = null;
    public $pageTitle = "Elecciones";
    public $pageBreadcrumb = [
        "Inicio" => null,
    ];

    public $description ="Test";
    public $election_type_id= null;

    public $showNewElection= false;
    public $newElection;

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    protected $rules = [      
        'newElection.election_type_id'=> ['required'],
        'newElection.description'=> ['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        
        return view('livewire.elections.index', [
            'items' => $this->items,
            'electionTypes' => ElectionType::pluck('description', 'id')
        ]);
    }

    public function updatingSelectAllItems()
    {
        $this->toggleSelectAllItems();
    }
    
    public function toggleSelectAllItems()
    {
        $this->selectAllItems = !$this->selectAllItems;

        if ($this->selectAllItems) {
            $this->selectedItems = $this->itemsQuery->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function resetVars()
    {
        $this->reset();
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
        return Election::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function openElectionModal()
    {
        $this->newElection= new Election;
        $this->emit('openElectionModal');

        
    }
}
