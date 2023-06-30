<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\models_dash\clsSchoolGrade;
use App\Models\models_dash\clsMunicipality;
use App\Models\models_dash\clsStructureCoordinators;
use App\Models\models_dash\clsActivities;
use App\Models\models_dash\clsStructure;

class CombosController extends Controller
 {
 	public function school_grade(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo Grado de estudios
        // Creación: Viernes 02 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsSchoolGrade::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $vresponse['respuesta']=clsSchoolGrade::queryToDB($vfilter)->get();
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

    public function district(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo distritos
        // Creación: Viernes 02 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructure::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $vresponse['respuesta']=clsStructure::queryToDistrictsDB($vfilter)->get();
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

    public function municipality(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo de municipios
        // Creación: Viernes 02 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructure::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $dtto_loc=$vrequest->input('dtto_loc');
                        if ( isset($dtto_loc) ) {
                            $vfilter['dtto_loc']=$dtto_loc;
                        }
                        $vresponse['respuesta']=clsStructure::queryToDBDistrictMpio($vfilter)->get();
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

    public function sections(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo de secciones
        // Creación: Martes 06 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructure::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $municipality=$vrequest->input('municipality');
                        $local_district=$vrequest->input('local_district');
                        
                        if ( isset($municipality) ) {
                            $vfilter['municipality']=$municipality;
                        }
                        if ( isset($local_district) ) {
                            $vfilter['local_district']=$local_district;
                        }
                        $vresponse['respuesta']=clsStructure::queryToDBSectionsMpio($vfilter)->get();
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

    public function promoters(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo de coordinators
        // Creación: Viernes 02 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructureCoordinators::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $section_id=$vrequest->input('section_id');
                        if ( isset($section_id) ) {
                            $vfilter['section_id']=$section_id;
                        }
                        $vresponse['respuesta']=clsStructureCoordinators::queryToDB($vfilter)->get();
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
     
    public function activities(Request $vrequest)
     {
        // Descripción: Función REST API al catalogo actividades
        // Creación: Lunes 05 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsActivities::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $vresponse['respuesta']=clsActivities::queryToDB($vfilter)->get();
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

    public function municipality_coordinator(Request $vrequest)
    {
        // Descripción: Función REST API al catalogo de coordinators municipales
        // Creación: Viernes 23 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructureCoordinators::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $municipality=$vrequest->input('municipality');
                        $local_district=$vrequest->input('local_district');
                        
                        if ( isset($municipality) ) {
                            $vfilter['municipality']=$municipality;
                        }
                        if ( isset($local_district) ) {
                            $vfilter['local_district']=$local_district;
                        }
                        
                        $vresponse['respuesta']=clsStructureCoordinators::queryToDBCoordinatorMunicipality($vfilter)->get();
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

    public function district_coordinator(Request $vrequest)
    {
        // Descripción: Función REST API al catalogo de coordinators district
        // Creación: Jueves 29 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructureCoordinators::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $local_district=$vrequest->input('local_district');
                       
                        if ( isset($local_district) ) {
                            $vfilter['local_district']=$local_district;
                        }
                        
                        $vresponse['respuesta']=clsStructureCoordinators::queryToDBCoordinatorDistrict($vfilter)->get();
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

    public function municipality_dtto(Request $vrequest)
    {
        // Descripción: Función REST API al catalogo de municipios de un distrito local
        // Creación: Jueves 28 de Junio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'show':
                        $vresponse['respuesta']=clsStructure::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $dtto=$vrequest->input('dtto');
                        
                        if ( isset($dtto) ) {
                            $vfilter['dtto_loc']=$dtto;
                        }                        
                        
                        $vresponse['respuesta']=clsStructure::queryToDBDistrictMpio($vfilter)->get();
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