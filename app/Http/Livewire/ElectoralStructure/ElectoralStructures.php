<?php

namespace App\Http\Livewire\ElectoralStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\Election;

class ElectoralStructures extends Component
{
    use WithPagination, WithSorting;
    public $title = 'Estructura electoral';
    public $election= "Elección";
    public $breadcrumb = [
        "Inicio" => null
    ];

    /*public $selectAllItems = false;
    public $selectedItems = [];
    public $paginate = 10;    
    public $search = '';*/

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public function render()
    {
        $this->election= Election::find(1)->description;
        return view('livewire.electoral-structures.index', );
    }
}
