<?php

namespace App\Http\Livewire\PromotedsStructure;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\StructurePromotedComment;
use App\Models\StructurePromoted;
use App\Models\StructurePromotedSupports;
use App\Models\SupportType;
use DB;

class PromotedsSupports extends Component
{
    public StructurePromoted $structurePromoted;
    public StructurePromotedSupports $structurePromotedSupports;
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Promovidos';
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;

    public $breadcrumb = [
        "Inicio" => "promovidos.index",
        "Apoyos" => null,
    ];

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    protected $rules = [      
        'structurePromotedSupports.structure_promoted_id'=> [],
        'structurePromotedSupports.support_type_id'=> [],
        'structurePromotedSupports.description'=> ['required'],
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(StructurePromoted $promoted, StructurePromotedSupports $structurePromotedSupports)
    {
        $this->structurePromoted= $promoted;
        $this->structurePromotedSupports= $structurePromotedSupports;
        //dd($this->structurePromotedSupports);
    }

    public function render()
    { 
        return view('livewire.promoteds-structure.promoteds-supports', [
            'items'=> $this->items,
            'supportTypes' => SupportType::pluck('description', 'id'),
        ]);
    }

    public function resetVars()
    {
        $this->resetExcept('structurePromoted');
        $this->resetPage();
        //$this->resetFiltros();
    }

    public function mountWithSorting()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
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
        return StructurePromotedSupports::list($this->structurePromoted->id)
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function delete($id)
    {
        StructurePromotedSupports::find($id)->delete();
    }

    public function save()
    {

        $this->validate();
        try{

            DB::beginTransaction();
            $this->structurePromotedSupports->structure_promoted_id= $this->structurePromoted->id;

            $this->structurePromotedSupports->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Seguimiento registrado'));
            //$this->resetVars();
            $this->redirectRoute('promovidos.apoyos.index', $this->structurePromoted);

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
