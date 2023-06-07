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

class clsStructurePromoteds extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'structure_promoteds';
    protected $fillable = [
        'id',
        'structure_id',
        'structure_coordinator_id',
        'member_id',        
        'promoted_type_id'
    ];

    protected $hidden = [
        //'id',
    ];

    public static function queryToDB($vfiltros=[])
     {

        $vqueryToDB=clsStructurePromoteds::select(
            'structure_promoteds.id',
            'structure_promoteds.structure_id',
            'structure_promoteds.structure_coordinator_id as promoter_id',
            'structure_coordinators.section as section_id',
            'structure_coordinators.municipality_key as municipality_id',
            'structure_coordinators.local_district as district_id',
            'members.firstname',
            'members.lastname',
            'members.sex',
            'members.birth_date',
            'members.age',
            'members.section',
            'members.electoral_key_validity',
            'members.electoral_key',
            'members.curp',
            'members.address',
            'members.neighborhood',
            'members.zip_code',
            'members.membership',
            'members.political_organization',
            'members.school_grade_id',
            'members.activity_id',
            'members.credential_front',
            'members.credential_back',
            'members.mobile_phone',
            'members.house_phone',
            'members.email',
            'members.has_social_networks',
            'members.facebook',
            'members.instagram',
            'members.twitter',
            'members.tiktok'
        );    
       
        $vqueryToDB = $vqueryToDB->join('members', 'members.id', '=', 'structure_promoteds.member_id');
        $vqueryToDB = $vqueryToDB->join('structure_coordinators', 'structure_coordinators.id', '=', 'structure_promoteds.structure_coordinator_id');

        if ( array_key_exists('id_promovido', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_promoteds.id', $vfiltros['id_promovido']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structure_promoteds.deleted_at');
        return $vqueryToDB;
     }
}