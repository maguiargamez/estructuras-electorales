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
}