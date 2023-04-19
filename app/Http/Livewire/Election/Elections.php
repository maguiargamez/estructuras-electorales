<?php

namespace App\Http\Livewire\Election;

use Livewire\Component;
use App\Http\Traits\WithSorting;
use App\Models\Elections as ModelsElections;
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

    public $showNewElection= false;

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.elections.index', ['items' => $this->items]);
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
        return ModelsElections::query()
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }
}
