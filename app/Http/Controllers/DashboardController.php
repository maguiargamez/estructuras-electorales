<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\models_dash\clsMembers;
use App\Models\models_dash\clsStructure;
use App\Models\models_dash\clsStructurePromoteds;
use App\Models\models_dash\clsVWPromotedsByMunicipality;

class DashboardController extends Controller
{
    public $election_id= 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $election= Election::with('electionType')->find($this->election_id);
        return view('dashboard.index', ['election'=>$election]);
    }
  
    public function result_data()
    {
        // Descripción: Función para datos del dashboard
        // Creación: Martes, 23 de Mayo de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
                $varray=array();

                $metaGlobal   = clsStructure::queryToDB(['election_id'=>1]);

                $coordEstatal   = count(clsMembers::queryToDBCoordinadores(['position_id'=>1])->get()); 
                $coordDistrital = count(clsMembers::queryToDBCoordinadores(['position_id'=>2])->get()); 
                $coordMunicipal = count(clsMembers::queryToDBCoordinadores(['position_id'=>3])->get()); 
                $promovidos     = count(clsStructurePromoteds::queryToDB(['position_id'=>6])->get()); 

                $sexoHPromovido = clsMembers::queryToDBSexoPromovidos(['sexo'=>1, 'promovido'=>true]);
                $sexoMPromovido = clsMembers::queryToDBSexoPromovidos(['sexo'=>0, 'promovido'=>true]);

                $menorEdad=0;
                $mayorEdad=0;
                $personalEdad = clsMembers::queryToEdad(['promovido'=>true])->get();
                foreach ($personalEdad as $value) {
                    if($value->edad_persona ==18)
                        $menorEdad = $menorEdad + 1;
                    else
                        $mayorEdad = $mayorEdad + 1;
                }

                $avancePromovidos = clsStructurePromoteds::queryToDBCountPromoteds()->first();

                $seccionesConPromovidos = clsStructure::queryToSectionWithPromoteds()->get();
                $totalSecciones = count($seccionesConPromovidos);
                $totalSeccionesConPromovidos = 0;
                $porcentajeAvanceSecciones = 0;

                foreach ($seccionesConPromovidos as $value) {
                    if($value->total > 0)
                        $totalSeccionesConPromovidos = $totalSeccionesConPromovidos + 1; 
                } 

                if($totalSeccionesConPromovidos > 0)
                    $porcentajeAvanceSecciones = ($totalSeccionesConPromovidos / $totalSecciones) * 100;


                $municipiosConPromovidos = clsStructure::queryToMunicipalityWithPromoteds()->get();
                $totalMunicipios = count($municipiosConPromovidos);
                $totalMunicipiosConPromovidos = 0;
                $porcentajeAvanceMunicipios = 0;

                foreach ($municipiosConPromovidos as $value) {
                    if($value->total > 0)
                        $totalMunicipiosConPromovidos = $totalMunicipiosConPromovidos + 1; 
                }
                
                if($totalMunicipiosConPromovidos > 0)
                    $porcentajeAvanceMunicipios = ($totalMunicipiosConPromovidos / $totalMunicipios) * 100;

                $lstPromovidosPorMunicipio = clsVWPromotedsByMunicipality::queryToDB()->get();


                $varray['metaGlobal'] = $metaGlobal->total_meta;
                $varray['avance_promovidos'] = $avancePromovidos->total_promovidos;

                $varray['totalSecciones'] = $totalSecciones;
                $varray['totalSeccionesConPromovidos'] = $totalSeccionesConPromovidos;
                $varray['porcentajeAvanceSeccion'] = round($porcentajeAvanceSecciones,1);

                $varray['totalMunicipios'] = $totalMunicipios;
                $varray['totalMunicipiosConPromovidos'] = $totalMunicipiosConPromovidos;
                $varray['porcentajeAvanceMunicipios'] = round($porcentajeAvanceMunicipios,1);

                $varray['lstPromovidosPorMunicipio'] = $lstPromovidosPorMunicipio;

                $varray['coordEstatal'] = $coordEstatal;
                $varray['coordDistrital'] = $coordDistrital;
                $varray['coordMunicipal'] = $coordMunicipal;
                $varray['promovidos'] = $promovidos;

                $varray['hombres_promovido'] = $sexoHPromovido->total_sexo;
                $varray['mujeres_promovido'] = $sexoMPromovido->total_sexo;

                $varray['menorEdad'] = $menorEdad;
                $varray['mayorEdad'] = $mayorEdad;

                $vresponse['respuesta']= $varray;
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

    public function promovidos_municipio($id_municipio)
    {
        $municipio = clsStructure::queryToDBCoordinatorMpio(['id_mpio'=>$id_municipio])->first();

        return view('dashboard.promovidos_municipio', ['id_municipio'=>$id_municipio, 'municipio'=>$municipio]);
    }

    public function getPromovidosMpio(Request $vrequest)
    {
        // Descripción: Función para consultar los promovidos por municipio
        // Creación: Jueves, 13 de Juio de 2023
        // Versión: 1.0.0

        $vHTTPCode=200;
        $vresponse=['codigo'=>1, 'mensaje'=>'Exito', 'icono'=>'success'];
        try {
            $vfilter=array();
            switch ($vrequest->method) {
                case 'get':
                    $filtro=array();
                    $filtro['id_municipio'] = $vrequest->id_municipio;   
                    $vresponse['respuesta']=clsStructurePromoteds::queryToDBPromotedsByMpio($filtro)->get();
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
