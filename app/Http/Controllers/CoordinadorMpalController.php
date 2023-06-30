<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FormatDate;
use App\Models\models_dash\clsStructure;
use App\Models\models_dash\clsMembers;
use App\Models\models_dash\clsStructureCoordinators;
use DB;
use File;

class CoordinadorMpalController extends Controller
{

	public function index()
     {
        return view('coordinador_mpio.index');
     }

	public function create()
     {
        return view('coordinador_mpio.create');
     } 

    public function store(Request $vrequest)
     {
        $vstatusHTTP=201;
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron insertar los datos, intente de nuevo.'];

        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization']; 

        $vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();

        $vdatosMember=$vrequest->only(                   
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

        $vdatosMember['position_id'] = 3;
        $vdatosMember['membership'] = $is_membership;
        $vdatosMember['political_organization'] = $is_organization;
        $vdatosMember['section_type'] = $vdatosSection->section_type;
        $vdatosMember['birth_date'] = FormatDate::formatDates($vdatosMember['birth_date']);

        $vflmember = new clsMembers;
        $vflcoordinatorMpio = new clsStructureCoordinators;

        try {
                DB::beginTransaction();

                if( !empty($vdatosSection) )
                {
                    $queryIne=clsMembers::queryToDB(['clave_elector' => $vrequest->electoral_key])->first();
                    
                    if ( empty($queryIne) ) {

                        $vrutaCarpeta= date('Y') .'/'. $vrequest->electoral_key;                        

                        $vineFrente = $vrequest->file('ine_frente');
                        if ($vrequest->hasFile('ine_frente')) {
                            if ($vrequest->file('ine_frente')->isValid()) {
                                $extF = $vineFrente->extension();
                                $vnombreArchivoExtension= $vrequest->electoral_key.'_front.'.$extF;     
                                $vrequest->file('ine_frente')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                $vdatosMember["credential_front"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                            }
                        }
                        
                        $vineTrasero = $vrequest->file('ine_reverso');
                        if ($vrequest->hasFile('ine_reverso')) {
                            if ($vrequest->file('ine_reverso')->isValid()) {
                                $extB = $vineTrasero->extension();
                                $vnombreArchivoExtension= $vrequest->electoral_key.'_back.'.$extB; 
                                $vrequest->file('ine_reverso')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                $vdatosMember["credential_back"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                            }
                        } 

                        $vflmember->fill($vdatosMember)->save();

                        /*Obtengo la descripcion del municipio*/
                        $mpio=clsStructure::queryToDBSelect(['id_mpio'=>$vrequest->municipality_id])->first();

                        /*Guardo los datos del coordinador municipal*/  
                        $vdatosCoordinator['election_id'] = 1;
                        $vdatosCoordinator['position_id'] = 3;
                        $vdatosCoordinator['structure_coordinator_id'] = $vrequest->coordinator_id;
                        $vdatosCoordinator['member_id'] = $vflmember->id;
                        $vdatosCoordinator['entity_key'] = 7;
                        $vdatosCoordinator['entity'] = 'Chiapas';
                        $vdatosCoordinator['local_district'] = $vrequest->district_id;                        
                        $vdatosCoordinator['municipality_key'] = $vrequest->municipality_id;                        
                        $vdatosCoordinator['municipality'] = $mpio->municipality;                        
                        $vdatosCoordinator['goal'] = $vrequest->goal;

                        $vflcoordinatorMpio->fill($vdatosCoordinator)->save();

                        $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Coordinador Municipal fue insertado exitosamente.'];
                        unset($vflmember, $vflcoordinatorMpio); 
                    }
                    else {
                        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrada, por favor verifiquelo.'];
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
        return view('coordinador_mpio.edit', ['id'=>$id]);
     } 

    public function update(Request $vrequest)
     {
       /**
         * 30 de Junio de 2023
         * Metodo para actualizar los datos de un coordinador municipal.
         * */

        $vstatusHTTP=201;        
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron actualizar los datos. intente de nuevo.' ];        
        
        $id_coordinador = $vrequest->input('idCoordinator');
        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization'];

        $vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();
        $vflcoordinatorMpio = clsStructureCoordinators::find($id_coordinador);
        $vflmember = clsMembers::find($vflcoordinatorMpio->member_id);

        $vdatosMember=$vrequest->only(                   
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

        $vdatosMember['membership'] = $is_membership;
        $vdatosMember['political_organization'] = $is_organization;
        $vdatosMember['section_type'] = $vdatosSection->section_type;
        $vdatosMember['birth_date'] = FormatDate::formatDates($vdatosMember['birth_date']);

        if($vrequest->has_social_networks == 0)
        {
            $vdatosMember['facebook']  = null;
            $vdatosMember['instagram'] = null;
            $vdatosMember['twitter']   = null;
            $vdatosMember['tiktok']    = null;
        }

        try {
                DB::beginTransaction();
                
                    if( !empty($vdatosSection) )
                    {
                        $queryIne=clsMembers::queryToDB(['clave_elector' => $vrequest->electoral_key, 'id_promovidoUPD'=>$vflcoordinatorMpio->member_id])->first();
                        if ( empty($queryIne) ) {

                            $vrutaCarpeta= date('Y') .'/'. $vrequest->electoral_key;
                            //actualizo los datos personales
                            $vineFrente = $vrequest->file('ine_frente');
                            if ($vrequest->hasFile('ine_frente')) {
                                if ($vrequest->file('ine_frente')->isValid()) {
                                    $extF = $vineFrente->extension();
                                    $vnombreArchivoExtension= $vrequest->electoral_key.'_front.'.$extF;                               
                                    $vrequest->file('ine_frente')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                    $vdatosMember["credential_front"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                                }
                            }
                            
                            $vineTrasero = $vrequest->file('ine_reverso');
                            if ($vrequest->hasFile('ine_reverso')) {
                                if ($vrequest->file('ine_reverso')->isValid()) {
                                    $extB = $vineTrasero->extension();
                                    $vnombreArchivoExtension= $vrequest->electoral_key.'_back.'.$extB;
                                    $vrequest->file('ine_reverso')->storeAs($vrutaCarpeta, $vnombreArchivoExtension, 'file-electoral');

                                    $vdatosMember["credential_back"]=$vrutaCarpeta .'/'. $vnombreArchivoExtension;
                                }
                            }

                            $vflmember->fill($vdatosMember)->save();

                            /*Obtengo la descripcion del municipio*/
                            $mpio=clsStructure::queryToDBSelect(['id_mpio'=>$vrequest->municipality_id])->first();

                            /*Guardo los datos del coordinador distrital*/                            
                            $vdatosCoordinator['structure_coordinator_id'] = $vrequest->coordinator_id;
                            $vdatosCoordinator['member_id'] = $vflmember->id;
                            $vdatosCoordinator['entity_key'] = 7;
                            $vdatosCoordinator['entity'] = 'Chiapas';
                            $vdatosCoordinator['local_district'] = $vrequest->district_id;                        
                            $vdatosCoordinator['municipality_key'] = $vrequest->municipality_id;                        
                            $vdatosCoordinator['municipality'] = $mpio->municipality;                        
                            $vdatosCoordinator['goal'] = $vrequest->goal;

                            $vflcoordinatorMpio->fill($vdatosCoordinator)->save();

                            $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Coordinador Municipal fue actualizado exitosamente.'];
                            unset($vflmember, $vflcoordinatorMpio);
                        }
                        else {
                            $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrado. Por favor verifiquelo.'];
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
                    $vresponse['respuesta']=clsStructureCoordinators::queryToDBDetailCoordinator(['id_coordinator'=>$vrequest->id_coordinador])->first();
                  break;
                case 'get':
                    $filtro=array();
                    $filtro['position_id'] = 3;   
                    $vresponse['respuesta']=clsStructureCoordinators::queryToDBListCoordinator($filtro)->get();
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