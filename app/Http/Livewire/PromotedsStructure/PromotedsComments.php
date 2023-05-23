<?php

namespace App\Http\Livewire\PromotedsStructure;

use App\Models\StructurePromoted;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use App\Models\StructurePromotedComment;
use Livewire\Component;
use DB;
class PromotedsComments extends Component
{
    public StructurePromoted $structurePromoted;
    public StructurePromotedComment $structurePromotedComment;
    use WithPagination, WithSorting;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Promovidos';
    public $paginate = 10;    
    public $search = '';
    public $electionId= 1;

    public $breadcrumb = [
        "Inicio" => "promovidos.index",
        "Seguimiento" => null,
    ];

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    protected $rules = [      
        'structurePromotedComment.structure_promoted_id'=> [],
        'structurePromotedComment.comment'=> ['required'],
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(StructurePromoted $promoted, StructurePromotedComment $structurePromotedComment)
    {
        $this->structurePromoted= $promoted;
        $this->structurePromotedComment= $structurePromotedComment;
        //dd($this->structurePromotedComment);
    }

    public function render()
    {
        return view('livewire.promoteds-structure.promoteds-comments',[
                'items'=> $this->items,
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
        return StructurePromotedComment::list($this->structurePromoted->id)
            ->search(trim($this->search))
            ->orderBy($this->sortBy, $this->sortDirection);
    }

    public function getItemsProperty()
    {
        return ($this->itemsQuery->paginate($this->paginate));
    }

    public function delete($id)
    {
        StructurePromotedComment::find($id)->delete();
    }

    public function save()
    {

        $this->validate();
        try{

            DB::beginTransaction();
            $this->structurePromotedComment->structure_promoted_id= $this->structurePromoted->id;

            $this->structurePromotedComment->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Seguimiento registrado'));
            //$this->resetVars();
            $this->redirectRoute('promovidos.segumiento.index', $this->structurePromoted);

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
