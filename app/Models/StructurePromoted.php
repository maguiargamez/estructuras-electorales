<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class StructurePromoted extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    public function promotedType(): BelongsTo
    {
        return $this->belongsTo(PromotedType::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query
        ->whereHas('member', function($query) use ($term) {
            $query->where('firstname', 'like', '%'.$term.'%')
            ->orWhere('lastname', 'like', '%'.$term.'%')
            ->orWhere(DB::raw('CONCAT(firstname, " ", lastname)'), 'like', '%'.$term.'%');
        })
        ;
    }

    static public function list($electionId){
        return StructurePromoted::select(
            'structure_promoteds.*',
            DB::raw('CONCAT(msc.firstname, " ", msc.lastname) as promoter')
        )
        ->leftJoin('structure_coordinators as sc', 'sc.id', '=', 'structure_promoteds.structure_coordinator_id')
        ->leftJoin('members as msc', 'msc.id', '=', 'sc.member_id')
        ->with('structure')
        ->with('member')
        ->with('promotedType');
    }

    static public function gender($electionId){
        return StructurePromoted::select(
            'm.sex',            
            DB::raw('count(*) as total')
        )        
        ->join('members as m', 'm.id', '=', 'structure_promoteds.member_id')
        ->groupBy('m.sex');
    }

    static public function promotedTypeTotals($electionId){

        return StructurePromoted::select(
            '*',            
            DB::raw('count(*) as total')
        )        
        ->with('promotedType')
        ->groupBy('promoted_type_id');
    }
}
