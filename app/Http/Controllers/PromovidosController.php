<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\models_dash\clsMembers;
use App\Models\models_dash\clsStructurePromoteds;
use App\Models\models_dash\clsStructure;
use App\Http\Classes\FormatDate;
use DB;
use File;

class PromovidosController extends Controller
{
	public function index()
     {
        ///return view('promovidos.index');
     }

	public function create()
     {
        return view('promovidos.create');
     }

    public function store(Request $vrequest)
     {
     	$vstatusHTTP=201;
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron insertar los datos, intente de nuevo.'];

        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization'];              

		$vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();

        $vdatos=$vrequest->only(
            'promoter_id', 
            'firstname', 
            'lastname', 
            'sex', 
            'birth_date', 
            'age', 
            'electoral_key_validity', 
            'electoral_key', 
            'curp', 
            'section', 
            'address',
            'neighborhood',
            'zip_code',
            'school_grade_id',
            'activity_id',
            'mobile_phone',
            'house_phone',
            'email',
            'has_social_networks',
            'facebook',
            'instagram',
            'twitter',
            'tiktok'
        );

        $vdatos['position_id'] = 6;
        $vdatos['membership'] = $is_membership;
        $vdatos['political_organization'] = $is_organization;

        try {
        		DB::beginTransaction();

        		if( !empty($vdatosSection) )
        		{

	                $queryIne=clsMembers::queryToDB(['clave_elector' => $vrequest->electoral_key])->first();
	            	if ( empty($queryIne) ) {

		        		$vrutaCarpeta= date('Y') .'/'. $vrequest->electoral_key;
		        		
		                $vflmember = new clsMembers;               
		                
		                $vineFrente = $vrequest->file('ine_frente');
		                if ($vrequest->hasFile('ine_frente')) {
		                    if ($vrequest->file('ine_frente')->isValid()) {
		                        $extF = $vineFrente->extension();
                                $vnombreArchivoExtension= $vrequest->electoral_key.'_front.'.$extF;     
		                        $vrequest->file('ine_frente')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

		                        $vdatos["credential_front"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
		                    }
		                }
		                
		                $vineTrasero = $vrequest->file('ine_reverso');
		                if ($vrequest->hasFile('ine_reverso')) {
		                    if ($vrequest->file('ine_reverso')->isValid()) {
                                $extB = $vineTrasero->extension();
		                        $vnombreArchivoExtension= $vrequest->electoral_key.'_back.'.$extB; 
		                        $vrequest->file('ine_reverso')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

		                        $vdatos["credential_back"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
		                    }
		                }            
		                
		                $vdatos['section_type'] = $vdatosSection->section_type;
		                $vdatos['birth_date'] = FormatDate::formatDates($vdatos['birth_date']);	              

		                $vflmember->fill($vdatos)->save();


		                $vflpromoted = new clsStructurePromoteds;
		                $vdatosPromoted['structure_id'] = $vdatosSection->id;                
		                $vdatosPromoted['structure_coordinator_id'] = $vrequest->promoter_id;                
		                $vdatosPromoted['member_id'] = $vflmember->id;                
		                $vdatosPromoted['promoted_type_id'] = 1;                
		                $vflpromoted->fill($vdatosPromoted)->save();
		           
		                $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Promovido fue insertado exitosamente.'];
		                unset($vflmember, $vflpromoted);
	            	}
		            else {
		                $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrado como promovido.'];
		            }
		        }
		        else
		        {
		        	$vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La seccion ingresada no se encuentra registrada. Por favor verifiquelo.'];
		        }
           
            DB::commit();
        }
        catch ( Exception $e ) {
            DB::rollback();
            $vstatusHTTP=500;
            $vrespuesta=[
                'icono'=>'danger', 
                'codigo'=> -1, 
                'message'=> 'Error en el servidor, verifiquelo con el administrador, '. $vexception->getMessage()
            ];
        }
        return response()->json($vresponse, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT);
     }

    public function edit($id)
     {
    	return view('promovidos.edit', ['id'=>$id]);
     }

    public function getDatos(Request $vrequest)
     {
        // Descripción: Función para consultar datos de promovidos
        // Creación: Martes, 06 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                    $vresponse['respuesta']=clsStructurePromoteds::queryToDB(['id_promovido'=>$vrequest->id_promovido])->first();
                  break;                
                default:
                    $vresponse=['codigo'=>0, 'mensaje'=>'Lo sentimos! Metodo no definido.', 'icono'=>'warning'];
                  break;
            }
        }
        catch (Exception $vexception) {
            $vHTTPCode=500;
            $vresponse=[
                'codigo'=>-1,
                'mensaje'=>'Error en el servidor! Comuniquese con su administrador '. $vexception->getMessage(),
                'icono'=>'danger'
            ];
        }
        return response()->json($vresponse, $vHTTPCode);
     }

    public function update(Request $vrequest)
     {
       /**
         * 07 de Junio de 2023
         * Metodo para actualizar los datos de un promovido.
         * */

        $vstatusHTTP=201;        
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron actualizar los datos. intente de nuevo.' ];        
        
        $id_promovido = $vrequest->input('id');
        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization'];

        $vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();
        $vflpromoted = clsStructurePromoteds::find($id_promovido);
        $vflmember = clsMembers::find($vflpromoted->member_id);

        $vdatos=$vrequest->only(
            'promoter_id', 
            'firstname', 
            'lastname', 
            'sex', 
            'birth_date', 
            'age', 
            'electoral_key_validity', 
            'electoral_key', 
            'curp',   
            'section', 
            'address',
            'neighborhood',
            'zip_code',
            'school_grade_id',
            'activity_id',
            'mobile_phone',
            'house_phone',
            'email',
            'has_social_networks',
            'facebook',
            'instagram',
            'twitter',
            'tiktok'
        );

        $vdatos['position_id'] = 6;
        $vdatos['membership'] = $is_membership;
        $vdatos['political_organization'] = $is_organization; 

        if($vrequest->has_social_networks == 0)
        {
            $vdatos['facebook']  = null;
            $vdatos['instagram'] = null;
            $vdatos['twitter']   = null;
            $vdatos['tiktok']    = null;
        }
           
        try {
            DB::beginTransaction();

                if( !empty($vdatosSection) )
                {
                    $queryIne=clsMembers::queryToDB(['clave_elector' => $vrequest->electoral_key, 'id_promovidoUPD'=>$vflpromoted->member_id])->first();
                    if ( empty($queryIne) ) {
                       
                        $vrutaCarpeta= date('Y') .'/'. $vrequest->electoral_key;
                        //actualizo los datos personales
                        $vineFrente = $vrequest->file('ine_frente');
                        if ($vrequest->hasFile('ine_frente')) {
                            if ($vrequest->file('ine_frente')->isValid()) {
                                $extF = $vineFrente->extension();
                                $vnombreArchivoExtension= $vrequest->electoral_key.'_front.'.$extF;                               
                                $vrequest->file('ine_frente')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                $vdatos["credential_front"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                            }
                        }
                        
                        $vineTrasero = $vrequest->file('ine_reverso');
                        if ($vrequest->hasFile('ine_reverso')) {
                            if ($vrequest->file('ine_reverso')->isValid()) {
                                $extB = $vineTrasero->extension();
                                $vnombreArchivoExtension= $vrequest->electoral_key.'_back.'.$extB;
                                $vrequest->file('ine_reverso')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                $vdatos["credential_back"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                            }
                        }            
                        
                        $vdatos['section_type'] = $vdatosSection->section_type;
                        $vdatos['birth_date'] = FormatDate::formatDates($vdatos['birth_date']);               

                        $vflmember->fill($vdatos)->save();

                        //actualizo al promovido
                        $vdatosPromoted['structure_id'] = $vdatosSection->id;                
                        $vdatosPromoted['structure_coordinator_id'] = $vrequest->promoter_id;
                        $vflpromoted->fill($vdatosPromoted)->save();

                        $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Promovido fue actualizado exitosamente.'];
                        unset($vflmember, $vflpromoted);

                    }
                    else {
                        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrado como promovido.'];
                    }
                }
                else
                {
                    $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La seccion ingresada no se encuentra registrada. Por favor verifiquelo.'];
                }
            DB::commit();
        }
        catch ( Exception $vexception ) {
            DB::rollBack();
            $vstatusHTTP=500;
            $vresponse=[
                'icono'=>'danger', 
                'codigo'=>-1, 
                'message'=>'Error en el servidor, verifiquelo con el administrador, '. $vexception->getMessage()               
            ];
        }       
            
        return response()->json($vresponse, $vstatusHTTP, [], JSON_HEX_APOS|JSON_HEX_QUOT); 
     }
}