<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DB;
class Structure extends Model
{
    use HasFactory;

    public function promoteds(): HasMany
    {
        return $this->hasMany(StructurePromoted::class);
    }

    static function localDistricts(){
        return Structure::select(DB::raw("CONCAT('Distrito ', local_district) AS description"), 'local_district', 'id')
        ->groupBy('local_district')
        ->pluck('description', 'local_district');
    }

    static function municipalities($electionId=1, $localDistrict=null){
        $query= Structure::select(
            DB::raw("CONCAT(municipality_key, '-', municipality) AS description"), 
            'local_district', 
            'municipality_key'
        );
    
        if($localDistrict){
            $query= $query->where('local_district', $localDistrict);
        }

        $query= $query->where('election_id', $electionId)
        ->groupBy('local_district')
        ->groupBy('municipality_key')
        ->pluck('description', 'municipality_key');   

        return $query;
    }


}
