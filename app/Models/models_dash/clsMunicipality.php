<?php

/**
 * Clase principal para consultas a la tabla municipality
 * 02 de JUnio de 2023
 * Versión 1.0.1
 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsMunicipality extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'municipality';
    protected $fillable = [
        'id',
        'dtto_fed',     
        'dtto_loc',     
        'clave',     
        'municipality',     
    ];

    protected $hidden = [
        //'id',
    ];

	public static function queryToDB($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla municipality
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsMunicipality::select('*');
        
        if(array_key_exists('id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('id', $vdatoFiltro);
            });
        }    
   
        if(array_key_exists('dtto_loc', $vfiltros)) {
            $vdatoFiltro=$vfiltros["dtto_loc"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('dtto_loc', $vdatoFiltro);
            });
        } 
        
        $vqueryToDB=$vqueryToDB->orderBy('id', 'DESC');
        return $vqueryToDB;
     }

    public static function queryToDistrictsDB($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla municipality
         * 02 de Junio de 2023
         * */
        return clsMunicipality::select('dtto_loc')->groupBy('dtto_loc')->orderBy('dtto_loc');
     }
}