<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class StructurePromotedComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query
        ->where(function($query) use ($term) {
            $query->where('comment', 'like', '%'.$term.'%');
        })
        ;
    }


    static public function list($structurePromotedId){
        return StructurePromotedComment::select('*')
        ->where('structure_promoted_id', $structurePromotedId);
    }
}
