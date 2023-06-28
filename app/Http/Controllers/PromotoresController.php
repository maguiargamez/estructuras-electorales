<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\FormatDate;
use App\Models\models_dash\clsMembers;
use App\Models\models_dash\clsStructureCoordinators;
use App\Models\models_dash\clsStructure;
use App\Models\models_dash\clsMunicipality;
use DB;
use File;

class PromotoresController extends Controller
{
	public function index()
     {
        ///return view('promovidos.index');
     }

	public function create()
     {
        return view('promotores.create');
     }

    public function store(Request $vrequest)
     {
     	$vstatusHTTP=201;
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron insertar los datos, intente de nuevo.'];

        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization']; 

        $vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section_promoter])->first();

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

        $vdatosMember['position_id'] = 5;
        $vdatosMember['membership'] = $is_membership;
        $vdatosMember['political_organization'] = $is_organization;

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

                        //Seccion de la credencial del promotor
                        $vdatosSectionIne = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();
                        $vdatosMember['section_type'] = $vdatosSectionIne->section_type;
                        $vdatosMember['birth_date'] = FormatDate::formatDates($vdatosMember['birth_date']);  

                        $vflmember->fill($vdatosMember)->save();


                        /*Guardo los datos del promotor*/
                        $mpio = clsMunicipality::find($vrequest->municipality_id);
                        $vflpromoter = new clsStructureCoordinators;
                        $vdatosPromoter['election_id'] = 1;
                        $vdatosPromoter['position_id'] = 5;
                        $vdatosPromoter['structure_coordinator_id'] = $vrequest->coordinator_id;
                        $vdatosPromoter['member_id'] = $vflmember->id;
                        $vdatosPromoter['entity_key'] = 7;
                        $vdatosPromoter['entity'] = 'Chiapas';
                        $vdatosPromoter['local_district'] = $vrequest->district_id;
                        $vdatosPromoter['municipality_key'] = $vrequest->municipality_id;
                        $vdatosPromoter['municipality'] = $mpio->municipality;
                        $vdatosPromoter['section'] = $vrequest->section_promoter;
                        $vdatosPromoter['goal'] = $vrequest->goal;

                        $vflpromoter->fill($vdatosPromoter)->save();

                        $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Promotor fue insertado exitosamente.'];
                        unset($vflmember, $vdatosPromoter);

                    }
                    else {
                        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrado como promotor.'];
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
    	return view('promotores.edit', ['id'=>$id]);
     }

    public function getDatos(Request $vrequest)
     {
        // Descripción: Función para consultar datos de promotores
        // Creación: Martes, 21 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                    $vresponse['respuesta']=clsStructureCoordinators::queryToDBDetails(['id_promotor'=>$vrequest->id_promotor])->first();
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
         * 23 de Junio de 2023
         * Metodo para actualizar los datos de un promotor.
         * */

        $vstatusHTTP=201;        
        $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'No se pudieron actualizar los datos. intente de nuevo.' ];        
        
        $id_promotor = $vrequest->input('id');
        $is_membership=$vrequest['membership'];  
        $is_organization=$vrequest['political_organization'];

        $vdatosSection = clsStructure::queryToDBSelect(['section'=>$vrequest->section_promoter])->first();
        $vflpromoter = clsStructureCoordinators::find($id_promotor);
        $vflmember = clsMembers::find($vflpromoter->member_id);

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
                        $queryIne=clsMembers::queryToDB(['clave_elector' => $vrequest->electoral_key, 'id_promovidoUPD'=>$vflpromoter->member_id])->first();
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

                                //Seccion de la credencial del promotor
                                $vdatosSectionIne = clsStructure::queryToDBSelect(['section'=>$vrequest->section])->first();
                                $vdatosMember['section_type'] = $vdatosSectionIne->section_type;                                
                                $vdatosMember['birth_date'] = FormatDate::formatDates($vdatosMember['birth_date']);               

                                $vflmember->fill($vdatosMember)->save();   

                                //actualizo al promotor  
                                $mpio = clsMunicipality::find($vrequest->municipality_id);                              
                                $vdatosPromoter['structure_coordinator_id'] = $vrequest->coordinator_id;
                                $vdatosPromoter['member_id'] = $vflmember->id;                             
                                $vdatosPromoter['local_district'] = $vrequest->district_id;
                                $vdatosPromoter['municipality_key'] = $vrequest->municipality_id;
                                $vdatosPromoter['municipality'] = $mpio->municipality;
                                $vdatosPromoter['section'] = $vrequest->section_promoter;
                                $vdatosPromoter['goal'] = $vrequest->goal;

                                $vflpromoter->fill($vdatosPromoter)->save();

                                $vresponse=['icono'=>'success', 'codigo'=> 1, 'mensaje'=> 'El Promotor fue actualizado exitosamente.'];
                                unset($vflmember, $vdatosPromoter);

                        }
                        else {
                            $vresponse=['icono'=>'warning', 'codigo'=> 0, 'mensaje'=> 'La clave de elector '. $vrequest->electoral_key .', ya ha sido registrado como promotor.'];
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