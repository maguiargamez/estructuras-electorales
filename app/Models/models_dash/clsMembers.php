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

class clsMembers extends Model

 {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'members';

    protected $fillable = [

        'id',
        'position_id',
        'firstname',
        'lastname',
        'sex',
        'birth_date', 
        'age',       
        'electoral_key',
        'electoral_key_validity',
        'curp',
        'section',
        'section_type',
        'address',
        'neighborhood',
        'zip_code',
        'membership',
        'political_organization',
        'school_grade_id',
        'activity_id',
        'mobile_phone',
        'house_phone',
        'email',
        'has_social_networks',
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'is_validated',
        'was_supported',
        'credential_front',
        'credential_back'

    ];



    protected $hidden = [

        //'id',

    ];

    public static function queryToDB($vfiltros=[])

     {
        /**
         * Consulta principal a la tabla members, para obtener datos 
         * 05 de Junio de 2023
         * */

        $vqueryToDB=clsMembers::select('*');

              
        if ( array_key_exists('clave_elector', $vfiltros) ) {
            $filtro= $vfiltros["clave_elector"];
            $vqueryToDB= $vqueryToDB->where( function($sql) use ($filtro){
                    $sql->where("members.electoral_key", $filtro);
                });
        }

        if ( array_key_exists('id_promovidoUPD', $vfiltros) ) {
            $filtro= $vfiltros["id_promovidoUPD"];
            $vqueryToDB= $vqueryToDB->where( function($sql) use ($filtro){
                    $sql->where("members.id", '!=', $filtro);
                });
        }

        $vqueryToDB=$vqueryToDB->whereNull('members.deleted_at');

        return $vqueryToDB;
     }

    public static function queryToDBCoordinadores($vfiltros=[])
     {
     	$vqueryToDB=clsMembers::select('members.id');
            
        if ( array_key_exists('position_id', $vfiltros) ) {
            $filtro= $vfiltros["position_id"];
            $vqueryToDB= $vqueryToDB->where( function($sql) use ($filtro){
                    $sql->where("members.position_id", $filtro);
                });
        }

        $vqueryToDB=$vqueryToDB->whereNull('members.deleted_at');
        return $vqueryToDB;
     }

	public static function queryToDBSexoPromovidos($vfiltros=[])
     {
        /**
         * Consulta principal a la tabla c_seccion
         * 11 de Mayode 2023
         * */

        $vqueryToDB=clsMembers::select(
            DB::raw('COUNT(members.id) as total_sexo')           
        );
    
        if ( array_key_exists('sexo', $vfiltros) ) {
            $filtro= $vfiltros["sexo"];
            $vqueryToDB= $vqueryToDB->where( function($sql) use ($filtro){
                    $sql->where("members.sex", $filtro);
                });
        }

        if ( array_key_exists('promovido', $vfiltros )) {
            $vqueryToDB=$vqueryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('members.position_id', 6);
            });
        }

        $vqueryToDB=$vqueryToDB->whereNull('members.deleted_at')->first();
        return $vqueryToDB;
     }

    public static function queryToEdad($vfiltros=[])

     {
        /**
         * Consulta principal a la tabla members, para obtener los promovidos
         * 15 de Mayo de 2023
         * */

        $queryToDB=clsMembers::select(
            DB::raw("CONCAT(members.firstname,' ',members.lastname)  AS persona"),        
           
            DB::raw("YEAR(CURDATE())-YEAR(birth_date) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(birth_date,'%m-%d'), 0 , -1 )  AS edad_persona"),
        );

              
        if ( array_key_exists('promovido', $vfiltros )) {
            $queryToDB=$queryToDB->where( function($vsql) use ($vfiltros) {               
                $vsql->where('members.position_id', 6);
            });
        }

        $queryToDB=$queryToDB->whereNull('members.deleted_at');

        return $queryToDB;
     }

}