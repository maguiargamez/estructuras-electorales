<?php

/**
 * Clase principal para consultas a la tabla promoted_types
 * 14 de Julio de 2023
 * Versión 1.0.1
 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsPromotedTypes extends Model
 {
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'promoted_types';
    protected $fillable = [
        'id',
        'description'     
    ];

    protected $hidden = [
        //'id',
    ];

	public static function queryToDB($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla activities
         * 05 de Junio de 2023
         * */
        $vqueryToDB=clsPromotedTypes::select('*');
        
        if(array_key_exists('id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('id', $vdatoFiltro);
            });
        }    
        
        $vqueryToDB=$vqueryToDB->orderBy('id', 'DESC');
        return $vqueryToDB;
     }
}