<?php
/**
 * Clase principal para consultas a la tabla structure_promoteds_sympathizer
 * 14 de Julio de 2022
 * Versión 1.0.1
 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsStructurePromotedsSympathizer extends Model
 {

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'structure_promoteds_sympathizer';
    protected $fillable = [
        'id',
        'structure_promoted_id',
        'promoted_type_id',
        'description',
        'date',
        'time'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($vfiltros=[])
     {
        $vqueryToDB=clsStructurePromotedsSympathizer::select(
            'structure_promoteds_sympathizer.id',
            'structure_promoteds_sympathizer.structure_promoted_id',
            'structure_promoteds_sympathizer.promoted_type_id',
            'structure_promoteds_sympathizer.description',
            'structure_promoteds_sympathizer.date',
            'structure_promoteds_sympathizer.time',
            'promoted_types.description as promoted_types'
        );
        $vqueryToDB=$vqueryToDB->join('promoted_types', 'structure_promoteds_sympathizer.promoted_type_id', '=', 'promoted_types.id');
        if ( array_key_exists('structure_promoted_id', $vfiltros) ) {
            $vdatoFiltro=$vfiltros["structure_promoted_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_promoteds_sympathizer.structure_promoted_id', $vdatoFiltro);
            });
        }   
        
        $vqueryToDB=$vqueryToDB->orderBy('id', 'DESC');
        return $vqueryToDB;
     }
}