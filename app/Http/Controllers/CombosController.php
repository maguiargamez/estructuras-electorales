<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\models_dash\clsSchoolGrade;
use App\Models\models_dash\clsMunicipality;
use App\Models\models_dash\clsStructureCoordinators;

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
                        $vresponse['respuesta']=clsMunicipality::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $vresponse['respuesta']=clsMunicipality::queryToDistrictsDB($vfilter)->get();
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
                        $vresponse['respuesta']=clsMunicipality::findOrFail($vrequest->id);
                    break;
                case 'get':
                        $dtto_loc=$vrequest->input('dtto_loc');
                        if ( isset($dtto_loc) ) {
                            $vfilter['dtto_loc']=$dtto_loc;
                        }
                        $vresponse['respuesta']=clsMunicipality::queryToDB($vfilter)->get();
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

    public function coordinators(Request $vrequest)
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
                        $municipality=$vrequest->input('municipality');
                        if ( isset($municipality) ) {
                            $vfilter['municipality']=$municipality;
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
 }