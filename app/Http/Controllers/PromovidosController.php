<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\models_dash\clsMembers;
use App\Models\models_dash\clsStructurePromoteds;
use App\Models\models_dash\clsStructurePromotedsSympathizer;
use App\Models\models_dash\clsStructure;
use App\Http\Classes\FormatDate;
use DB;
use File;

class PromovidosController extends Controller
{
    public function simpatizantes_index()
     {
        return view('promovidos.simpatizantes.index');
     }

    public function sympathizer_store(Request $vrequest)
     {
        // Descripción: Función REST API para determinar si es simpatizante o no.
        // Creación: Martes, 23 de Mayo de 2023
        // Versión: 1.0.0
        // Parametros: Request

        $vHTTPCode=200;
        $vresponse=['codigo'=>0, 'icono'=>'warning', 'mensaje'=>'No se pudieron guardar los registros'];
        DB::beginTransaction();
        try {
            $vfilter=array();
            $vflStructurePromoteds=clsStructurePromoteds::find($vrequest->structure_promoted_id);
            $vflStructurePromoteds->fill(['promoted_type_id' => $vrequest->promoted_type_id])->save();

            $vflStructurePromotedsSympathizer=new clsStructurePromotedsSympathizer;
            $vflStructurePromotedsSympathizer->fill(
                [
                    'structure_promoted_id' => $vrequest->structure_promoted_id,
                    'promoted_type_id' => $vrequest->promoted_type_id,
                    'description' => $vrequest->description,
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s')
                ]
            )->save();

            $vresponse=['codigo'=>1, 'icono'=>'success', 'mensaje'=>'Los datos han sido guardados exitosamente.'];
            DB::commit();
        }
        catch (Exception $vexception) {
            DB::rollback();
            $vHTTPCode=500;
            $vresponse=[
                'codigo'=>-1,
                'mensaje'=>'Error en el servidor! Comuniquese con su administrador '. $vexception->getMessage(),
                'icono'=>'danger'
            ];
        }
        return response()->json($vresponse, $vHTTPCode);
     }

    public function getResultSympathizer(Request $vrequest)
     {
        // Descripción: Función para consultar los coordinadores municipales
        // Creación: Jueves, 29 de Juio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':                    
                    // $vresponse['respuesta']=clsStructurePromotedsSympathizer::queryToDB(['id_coordinator'=>$vrequest->id_coordinador])->first();
                  break;
                case 'get':
                    $vfilter['structure_promoted_id']=$vrequest->structure_promoted_id;
                    $vresponse['respuesta']=clsStructurePromotedsSympathizer::queryToDB($vfilter)->get();
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

	public function index()
     {
        return view('promovidos.index');
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
    		if( !empty($vdatosSection) ) {
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
	        else {
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

            if( !empty($vdatosSection) ) {
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
            else {
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

    public function getResult(Request $vrequest)
     {
        // Descripción: Función para consultar los coordinadores municipales
        // Creación: Jueves, 29 de Juio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':                    
                    // $vresponse['respuesta']=clsStructureCoordinators::queryToDBDetailCoordinator(['id_coordinator'=>$vrequest->id_coordinador])->first();
                  break;
                case 'get':
                    $local_district=$vrequest->local_district;
                    $municipality_key=$vrequest->municipality_key;
                    $electoral_key=$vrequest->electoral_key;
                    $coordinator_id=$vrequest->coordinator_id;
                    $promoter_id=$vrequest->promoter_id;

                    if ( isset($local_district) )       $vfilter['local_district']=$vrequest->local_district;
                    if ( isset($municipality_key) )     $vfilter['municipality_key']=$vrequest->municipality_key;
                    if ( isset($electoral_key) )        $vfilter['electoral_key']=$vrequest->electoral_key;
                    if ( isset($coordinator_id) )       $vfilter['coordinator_id']=$vrequest->coordinator_id;
                    if ( isset($promoter_id) )          $vfilter['promoter_id']=$vrequest->promoter_id;

                    $vfilter['position_id']=6;
                    $_queryToPromovidos=clsStructurePromoteds::queryToDB($vfilter)->get();
                    $vresponse['respuesta']=$_queryToPromovidos;
                    $vresponse['total_meta']=clsStructure::queryToDB([]);

                    unset($_queryToPromovidos);

                    $vfilter['sex']=true; $vresponse['total_hombres']=count(clsStructurePromoteds::queryToDB($vfilter)->get());
                    $vfilter['sex']=false; $vresponse['total_mujeres']=count(clsStructurePromoteds::queryToDB($vfilter)->get());
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

    public function getResultSimpatizantes(Request $vrequest)
     {
        // Descripción: Función para consultar los coordinadores municipales
        // Creación: Jueves, 29 de Juio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            $vfilter['position_id']=6;
            switch ($vrequest->method) {
                case 'show':                    
                    // $vresponse['respuesta']=clsStructureCoordinators::queryToDBDetailCoordinator(['id_coordinator'=>$vrequest->id_coordinador])->first();
                  break;
                case 'get':
                    $local_district=$vrequest->local_district;
                    $municipality_key=$vrequest->municipality_key;
                    $electoral_key=$vrequest->electoral_key;
                    $coordinator_id=$vrequest->coordinator_id;
                    $promoter_id=$vrequest->promoter_id;

                    if ( isset($local_district) )       $vfilter['local_district']=$vrequest->local_district;
                    if ( isset($municipality_key) )     $vfilter['municipality_key']=$vrequest->municipality_key;
                    if ( isset($electoral_key) )        $vfilter['electoral_key']=$vrequest->electoral_key;
                    if ( isset($coordinator_id) )       $vfilter['coordinator_id']=$vrequest->coordinator_id;
                    if ( isset($promoter_id) )          $vfilter['promoter_id']=$vrequest->promoter_id;

                    $vflPromovidosTotal=count(clsStructurePromoteds::queryToDB($vfilter)->get());
                    $vresponse['total_promovidos']=$vflPromovidosTotal;
                    $vresponse['total_meta']=clsStructure::queryToDB([]);
                    unset($vflPromovidosTotal);

                    $vfilter['promoted_type_id']=1; $_no_definidos=clsStructurePromoteds::queryToDB($vfilter)->get();
                    $vfilter['promoted_type_id']=2; $_simpatizantes=clsStructurePromoteds::queryToDB($vfilter)->get();
                    $vfilter['promoted_type_id']=3; $_no_simpatizantes=clsStructurePromoteds::queryToDB($vfilter)->get();
                    $vfilter['promoted_type_id']=4; $_indecisos=clsStructurePromoteds::queryToDB($vfilter)->get();

                    $vresponse['no_definido']=$_no_definidos;
                    $vresponse['simpatizante']=$_simpatizantes;
                    $vresponse['no_simpatizante']=$_no_simpatizantes;
                    $vresponse['indeciso']=$_indecisos;

                    $vresponse['total_no_definido']=count($_no_definidos);
                    $vresponse['total_simpatizante']=count($_simpatizantes);
                    $vresponse['total_no_simpatizante']=count($_no_simpatizantes);
                    $vresponse['total_indeciso']=count($_indecisos);

                    
                    unset($_no_definidos, $_simpatizantes, $_no_simpatizantes, $_indecisos);

                    // $vfilter['sex']=true;   $vresponse['total_hombres']=count(clsStructurePromoteds::queryToDB($vfilter)->get());
                    // $vfilter['sex']=false;  $vresponse['total_mujeres']=count(clsStructurePromoteds::queryToDB($vfilter)->get());
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
}