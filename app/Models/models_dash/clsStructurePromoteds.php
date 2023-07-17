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
            'structure_promoteds.structure_coordinator_id as promoter_id',
            'structure_coordinators_c.id as coordinator_id',
            'structure_promoteds.structure_id',
            'structure_coordinators.section as section_id',
            'structure_coordinators.municipality_key as municipality_id',
            'structure_coordinators.local_district as district_id',
            'structure_coordinators.municipality',            
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
            'members.tiktok',
            DB::raw("
                CONCAT(
                    members.firstname,' ',
                    members.lastname
                )  AS promovido"
            ),
            DB::raw(
                "CONCAT(
                    members_p.firstname,' ',
                    members_p.lastname
                )  AS promotor"
            ),
            DB::raw(
                "CONCAT(
                    members_c.firstname,' ',
                    members_c.lastname
                )  AS coordinador"
            )
        );       
        $vqueryToDB=$vqueryToDB->join('members', 'structure_promoteds.member_id' ,'=', 'members.id');
        $vqueryToDB=$vqueryToDB->join('structure_coordinators', 'structure_promoteds.structure_coordinator_id' ,'=', 'structure_coordinators.id');
        $vqueryToDB=$vqueryToDB->join('members AS members_p', 'structure_coordinators.member_id' ,'=', 'members_p.id');        
        $vqueryToDB=$vqueryToDB->join('structure_coordinators AS structure_coordinators_c', 'structure_coordinators.structure_coordinator_id' ,'=', 'structure_coordinators_c.id');
        $vqueryToDB=$vqueryToDB->join('members AS members_c', 'structure_coordinators_c.member_id' ,'=', 'members_c.id');

        if ( array_key_exists('id_promovido', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_promoteds.id', $vfiltros['id_promovido']);
            });
        }
        if(array_key_exists('local_district', $vfiltros)) {
            $vdatoFiltro=$vfiltros["local_district"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.local_district', $vdatoFiltro);
            });
        } 
        if(array_key_exists('municipality_key', $vfiltros)) {
            $vdatoFiltro=$vfiltros["municipality_key"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.municipality_key', $vdatoFiltro);
            });
        }
        if(array_key_exists('electoral_key', $vfiltros)) {
            $vdatoFiltro=$vfiltros["electoral_key"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('members.electoral_key', $vdatoFiltro);
            });
        }
        if(array_key_exists('sex', $vfiltros)) {
            $vdatoFiltro=$vfiltros["sex"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('members.sex', $vdatoFiltro);
            });
        }
        if(array_key_exists('coordinator_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["coordinator_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators_c.id', $vdatoFiltro);
            });
        }
        if(array_key_exists('promoter_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["promoter_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.id', $vdatoFiltro);
            });
        }
        if(array_key_exists('promoted_type_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["promoted_type_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_promoteds.promoted_type_id', $vdatoFiltro);
            });
        }
        
        $vqueryToDB=$vqueryToDB->whereNull('structure_promoteds.deleted_at');
        return $vqueryToDB;
     }
}