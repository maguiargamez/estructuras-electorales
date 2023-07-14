<?php

/**

 * Clase principal para consultas a la la vista de promovidos por municipio

 * 13 de Julio de 2023

 * Versión 1.0.1

 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use DB;

class clsVWPromotedsByMunicipality extends Model
 {

    protected $table = 'vw_promoteds_by_municipality';

    protected $fillable = [
        'local_district',
        'municipality_key',
        'municipality',
        'total'
    ];

    public static function queryToDB($vfiltros=[])
     {

        $vqueryToDB=clsVWPromotedsByMunicipality::select(
            'local_district',
            'municipality_key',
            'municipality',
            DB::raw('SUM(total) as total')           
        ); 
      
        $vqueryToDB=$vqueryToDB->groupBy('local_district')->groupBy('municipality_key');
        return $vqueryToDB;
     }
}