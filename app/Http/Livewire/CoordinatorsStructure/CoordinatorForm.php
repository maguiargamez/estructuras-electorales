<?php

namespace App\Http\Livewire\CoordinatorsStructure;

use App\Models\Position;
use App\Models\Structure;
use App\Models\StructureCoordinator;
use Livewire\Component;
use DB;
class CoordinatorForm extends Component
{
    public $title = 'Coordinadores';
    public $electionId= 1;
    public $positionId= [];
    public $localDistricts= [];
    public $municipalities= [];
    //public $positions= [];

    public $breadcrumb = [
        "Inicio" => "coordinadores.index"
    ];

    protected $listeners = [
        'refresh-data' => '$refresh',
    ];

    public StructureCoordinator $structureCoordinator;

    protected $rules = [      
        'structureCoordinator.election_id'=> [],
        'structureCoordinator.position_id'=> [],
        'structureCoordinator.structure_coordinator_id'=> ['integer', 'nullable'],
        'structureCoordinator.member_id'=> [],
        'structureCoordinator.entity_key'=> [],
        'structureCoordinator.entity'=> [],
        'structureCoordinator.federal_district'=> [],
        'structureCoordinator.local_district'=> [],
        'structureCoordinator.municipality_key'=> [],
        'structureCoordinator.municipality'=> [],
        'structureCoordinator.zone_key'=> [],
        'structureCoordinator.zone'=> [],
        'structureCoordinator.section'=> [],
        'structureCoordinator.goal'=> [],
    ];

    //Ejemplo
    protected $messages= [
        'tree_key.required' => 'El campo :attribute es obligatorio'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedStructureCoordinatorLocalDistrict($localDistrict){
        $this->municipalities= [];
        if($localDistrict!=""){
            $this->municipalities= Structure::municipalities(1, $localDistrict);
        }
        
    }

    public function mount(StructureCoordinator $structureCoordinator)
    {
        $this->structureCoordinator= $structureCoordinator;
        if($structureCoordinator->id!=null){
            $this->breadcrumb["Editar"]= null;
        }else{
            $this->breadcrumb["Crear"]= null;
        }
    }


    public function render()
    {
        //dd(Structure::localDistricts());
        $this->localDistricts= Structure::localDistricts();
        return view('livewire.coordinators-structure.form', 
        [
            'positions' => Position::whereIn('id',[2, 3])->pluck('description', 'id'),
            'localDistricts' => $this->localDistricts,
            'municipalities' => $this->municipalities
            /*'treeLifeCycles' => TreeLifeCycle::pluck('description', 'id'),
            'treeTypes' => TreeType::pluck('description', 'id'),
            'locations' => Location::pluck('description', 'id'),*/
        ]);
    }

    public function save()
    {
        $this->validate();

        try{

            DB::beginTransaction();
            
            //if(isset($this->tree->seedtime)){ $this->tree->seedtime= Carbon::createFromFormat('d/m/Y', $this->tree->seedtime)->format('Y-m-d'); }        
            //(!isset($this->tree->is_available)) ? $this->tree->is_available=0 : $this->tree->is_available= $this->tree->is_available;

            $this->tree->save();
            DB::commit(); 

            session()->flash('flashStatus', __('Coordinador registrado'));
            $this->redirectRoute('coordinadores.index');

        }catch (\Exception $e) {
            session()->flash('flashError', __($e->getMessage()));
            DB::rollback();                       
        }
    }
}
