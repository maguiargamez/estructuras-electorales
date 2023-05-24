<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StructurePromotedSupports extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function supportType(): BelongsTo
    {
        return $this->belongsTo(SupportType::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query
        ->where(function($query) use ($term) {
            $query->where('description', 'like', '%'.$term.'%');
        })
        ;
    }


    static public function list($structurePromotedId){
        return StructurePromotedSupports::select('*')
        ->with('supportType')
        ->where('structure_promoted_id', $structurePromotedId);
    }
}
