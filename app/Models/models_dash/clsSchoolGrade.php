<?php

/**
 * Clase principal para consultas a la tabla school grade
 * 02 de JUnio de 2023
 * Versión 1.0.1
 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsSchoolGrade extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'school_grades';
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
         * Consulta principal a la tabla school_grades
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsSchoolGrade::select('*');
        
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