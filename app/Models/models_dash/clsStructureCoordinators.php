<?php

/**
 * Clase principal para consultas a la tabla strucured_coordinator
 * 02 de Junio de 2023
 * Versión 1.0.1
 * */

namespace App\Models\models_dash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class clsStructureCoordinators extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'structure_coordinators';
    protected $fillable = [
        'id',
        'election_id',     
        'position_id',     
        'structure_coordinator_id',     
        'member_id',     
        'entity_key',     
        'entity',     
        'federal_district',     
        'local_district',     
        'municipality_key',     
        'municipality',     
        'zone_key',     
        'zone',     
        'section',     
        'goal'     
    ];

    protected $hidden = [
        //'id',
    ];

	public static function queryToDB($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla coordinators
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            DB::raw("CONCAT(members.firstname,' ',members.lastname)  AS coordinator"),
        );
        
        $vqueryToDB = $vqueryToDB->leftJoin('members', 'members.id', '=', 'structure_coordinators.member_id');

        if(array_key_exists('id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.id', $vdatoFiltro);
            });
        }
        if(array_key_exists('coordinator_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["coordinator_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.structure_coordinator_id', $vdatoFiltro);
            });
        }
        if(array_key_exists('section_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["section_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.section', $vdatoFiltro);
            });
        } 
        
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.election_id', 1);
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.position_id', 5);

        $vqueryToDB=$vqueryToDB->orderBy('members.firstname', 'ASC');
        return $vqueryToDB;
     }

    public static function queryToDBCoordinatorMunicipality($vfiltros=[])
     {

        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            DB::raw("CONCAT(members.firstname,' ',members.lastname)  AS coordinator"),
        );  

        $vqueryToDB = $vqueryToDB->leftJoin('members', 'members.id', '=', 'structure_coordinators.member_id');

        if ( array_key_exists('municipality', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_coordinators.municipality_key', $vfiltros['municipality']);
            });
        }
        
        if ( array_key_exists('local_district', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_coordinators.local_district', $vfiltros['local_district']);
            });
        }

        $vqueryToDB=$vqueryToDB->where('structure_coordinators.election_id', 1);
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.position_id', 3);
        $vqueryToDB=$vqueryToDB->whereNull('structure_coordinators.deleted_at');
        $vqueryToDB=$vqueryToDB->orderBy('structure_coordinators.id', 'ASC');
        
        return $vqueryToDB;
     }

    public static function queryToDBCoordinatorDistrict($vfiltros=[])
     {

        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            DB::raw("CONCAT(members.firstname,' ',members.lastname)  AS coordinator"),
        );  

        $vqueryToDB = $vqueryToDB->leftJoin('members', 'members.id', '=', 'structure_coordinators.member_id');
        
        if ( array_key_exists('local_district', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_coordinators.local_district', $vfiltros['local_district']);
            });
        }

        $vqueryToDB=$vqueryToDB->where('structure_coordinators.election_id', 1);
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.position_id', 2);
        $vqueryToDB=$vqueryToDB->whereNull('structure_coordinators.deleted_at');
        $vqueryToDB=$vqueryToDB->orderBy('structure_coordinators.id', 'ASC');
        
        return $vqueryToDB;
     }

    public static function queryToDBDetails($vfiltros=[])
     {
        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            'structure_coordinators.local_district as district_id',
            'structure_coordinators.municipality_key as municipality_id',
            'structure_coordinators.structure_coordinator_id as coordinator_id',
            'structure_coordinators.section as section_promoter',            
            'structure_coordinators.goal',            
            'members.firstname',
            'members.lastname',
            'members.sex',
            'members.birth_date',
            'members.age',            
            'members.electoral_key_validity',
            'members.electoral_key',
            'members.curp',
            'members.section',
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
       
        $vqueryToDB = $vqueryToDB->join('members', 'members.id', '=', 'structure_coordinators.member_id');
      
        if ( array_key_exists('id_promotor', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_coordinators.id', $vfiltros['id_promotor']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structure_coordinators.deleted_at');
        return $vqueryToDB;
     }

    public static function queryToDBListCoordinator($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla coordinators
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            DB::raw("CONCAT(members.firstname,' ',members.lastname)  AS coordinator"),
            'members.electoral_key',
            'members.electoral_key_validity',
            'positions.description as position',
            'structure_coordinators.local_district'
        );
        
        $vqueryToDB = $vqueryToDB->leftJoin('members', 'members.id', '=', 'structure_coordinators.member_id');
        $vqueryToDB = $vqueryToDB->leftJoin('positions', 'positions.id', '=', 'structure_coordinators.position_id');

        if(array_key_exists('id_coordinator', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id_coordinator"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.id', $vdatoFiltro);
            });
        }    
   
        if(array_key_exists('position_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["position_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.position_id', $vdatoFiltro);
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
        
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.election_id', 1);

        $vqueryToDB=$vqueryToDB->orderBy('structure_coordinators.id', 'DESC');
        return $vqueryToDB;
     }

    public static function queryToDBListPromotor($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla coordinators para traer los promotores
         * 02 de Junio de 2023
         * */
        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            DB::raw("
                CONCAT(
                    members.firstname,' ',
                    members.lastname
                )  AS promotor"
            ),
            DB::raw(
                "CONCAT(
                    members_depend.firstname,' ',
                    members_depend.lastname
                )  AS coordinador"
            ),
            'members.electoral_key',
            'members.electoral_key_validity',
            'positions.description as position',
            'structure_coordinators.local_district',
            'structure_coordinators.municipality'
        );
        
        $vqueryToDB = $vqueryToDB->leftJoin('members', 'members.id', '=', 'structure_coordinators.member_id');
        $vqueryToDB = $vqueryToDB->leftJoin('positions', 'positions.id', '=', 'structure_coordinators.position_id');
        $vqueryToDB = $vqueryToDB->leftJoin('structure_coordinators as struc_coord_depend', 'structure_coordinators.structure_coordinator_id', '=', 'struc_coord_depend.id');
        $vqueryToDB = $vqueryToDB->leftJoin('members as members_depend', 'struc_coord_depend.member_id', '=', 'members_depend.id');

        if(array_key_exists('id_coordinator', $vfiltros)) {
            $vdatoFiltro=$vfiltros["id_coordinator"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.id', $vdatoFiltro);
            });
        }    
   
        if(array_key_exists('position_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["position_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.position_id', $vdatoFiltro);
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
        if(array_key_exists('structure_coordinator_id', $vfiltros)) {
            $vdatoFiltro=$vfiltros["structure_coordinator_id"];
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vdatoFiltro) {
                $vsql->where('structure_coordinators.structure_coordinator_id', $vdatoFiltro);
            });
        }
                
        $vqueryToDB=$vqueryToDB->where('structure_coordinators.election_id', 1);
        $vqueryToDB=$vqueryToDB->orderBy('structure_coordinators.id', 'DESC');
        return $vqueryToDB;
     }

    public static function queryToDBDetailCoordinator($vfiltros=[])
     {
        $vqueryToDB=clsStructureCoordinators::select(
            'structure_coordinators.id',
            'structure_coordinators.structure_coordinator_id as coordinator_id',
            'structure_coordinators.local_district as district_id',       
            'structure_coordinators.municipality_key as municipality_id',       
            'structure_coordinators.goal',            
            'members.firstname',
            'members.lastname',
            'members.sex',
            'members.birth_date',
            'members.age',            
            'members.electoral_key_validity',
            'members.electoral_key',
            'members.curp',
            'members.section',
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
       
        $vqueryToDB = $vqueryToDB->join('members', 'members.id', '=', 'structure_coordinators.member_id');
      
        if ( array_key_exists('id_coordinator', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('structure_coordinators.id', $vfiltros['id_coordinator']);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('structure_coordinators.deleted_at');
        return $vqueryToDB;
     }    
}