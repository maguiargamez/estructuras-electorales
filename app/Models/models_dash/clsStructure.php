<?php

/**

 * Clase principal para consultas a la tabla p_personal

 * 29 de Diciembre de 2022

 * Versión 1.0.1

 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsStructure extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'structures';

    protected $fillable = [

        'id',
        'election_id',
        'entity_key',
        'entity',
        'federal_district',
        'local_district',        
        'municipality_key',
        'municipality',
        'zone_key',
        'zone',
        'section',
        'section_type_key',
        'section_type',
        'goal'
    ];



    protected $hidden = [

        //'id',

    ];

	public static function queryToDB($vfiltros=[])
     {

        $vqueryToDB=clsStructure::select(
            DB::raw('SUM(structures.goal) as total_meta')           
        );    
       
        if ( array_key_exists('election_id', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structures.election_id', $vfiltros['election_id']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structures.deleted_at')->first();
        return $vqueryToDB;
     }

    public static function queryToDBSelect($vfiltros=[])
     {

        $vqueryToDB=clsStructure::select('*');    
       
        if ( array_key_exists('section', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structures.section', $vfiltros['section']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structures.deleted_at');
        return $vqueryToDB;
     }


    public static function queryToDBSectionsMpio($vfiltros=[])
     {

        $vqueryToDB=clsStructure::select('id', 'section');  

        if ( array_key_exists('municipality', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structures.municipality_key', $vfiltros['municipality']);
            });
        }
        
        if ( array_key_exists('local_district', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structures.local_district', $vfiltros['local_district']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structures.deleted_at');
        $vqueryToDB=$vqueryToDB->groupBy('structures.section');
        $vqueryToDB=$vqueryToDB->orderBy('structures.section', 'ASC');
        return $vqueryToDB;
     }

    public static function queryToDistrictsDB($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla structure
         * 02 de Junio de 2023
         * */
        return clsStructure::select('local_district as dtto_loc')->groupBy('local_district')->orderBy('local_district');
     }

    public static function queryToDBDistrictMpio($vfiltros=[])
     {
        /**
         * Consulta principal a para traer los municipios de un distrito
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsStructure::select('*');
        
        if(array_key_exists('id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('id', $vdatoFiltro);
            });
        }    
   
        if(array_key_exists('dtto_loc', $vfiltros)) {
            $vdatoFiltro=$vfiltros["dtto_loc"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('local_district', $vdatoFiltro);
            });
        } 
        
        $vqueryToDB=$vqueryToDB->groupBy('municipality_key');
        $vqueryToDB=$vqueryToDB->orderBy('id', 'DESC');
        return $vqueryToDB;
     }
}