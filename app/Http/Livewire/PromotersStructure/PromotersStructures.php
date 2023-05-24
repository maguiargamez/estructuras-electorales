<?php

namespace App\Http\Livewire\PromotersStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\StructureCoordinator;

class PromotersStructures extends Component
{
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Promotores';
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
        return view('livewire.promoters-structure.index',[
            'items'=> $this->items
        ]);
    }

    public function resetVars()
    {
        $this->resetExcept();
        $this->resetPage();
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
        return StructureCoordinator::listPromoters($this->electionId)
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }


}
