<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class StructureCoordinator extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('id', 'like', '%'.$term.'%');
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    static public function promotersList()
    {
        return StructureCoordinator::select('structure_coordinators.id', 'members.firstname', 'members.lastname', 'electoral_key', 'structure_coordinators.section', 'structure_coordinators.goal')
        ->join('members', 'members.id', '=', 'structure_coordinators.member_id')
        ->where('structure_coordinators.position_id', 5)->orderBy('structure_coordinators.id')->orderBy('id', 'desc')
        ;
    }

    static public function dashboardTotals($electionId){

        return  StructureCoordinator::select(
            'positions.description as coordinator',
            DB::raw('count(*) as totalCoordinators'),
            DB::raw('
            (CASE
                WHEN position_id = 1 THEN (select COUNT(DISTINCT(entity_key)) from structures where election_id=1 )
                WHEN position_id = 2 THEN (select COUNT(DISTINCT(local_district)) from structures where election_id=1 )
                WHEN position_id = 3 THEN (select COUNT(DISTINCT(municipality_key)) from structures where election_id=1 )
                WHEN position_id = 4 THEN (select COUNT(DISTINCT(zone_key)) from structures where election_id=1 )
                ELSE 0
            END) as totals
            '),
        )
        ->join('positions', 'positions.id', '=', 'structure_coordinators.position_id')
        ->where('election_id', $electionId)
        ->whereIn('position_id', [1,2,3,4])
        ->groupBy('position_id')
        ;
    }

    static public function list($electionId){
        return StructureCoordinator::select(
            'structure_coordinators.*',
            DB::raw('(select sum(t2.goal) from structure_coordinators as t2 where t2.structure_coordinator_id=structure_coordinators.id and t2.position_id=5) as goal2 '),
            DB::raw('(select count(*) from structure_coordinators as t2 where t2.structure_coordinator_id=structure_coordinators.id and t2.position_id=5) as promoteds '),            

        )
        ->with('member')
        ->with('position')
        ->where('structure_coordinators.election_id', $electionId)
        ->whereIn('structure_coordinators.position_id', [1,2,3,4]);
    }

    public static function queryToDBCoordinadores($vfiltros=[])
    {
    }
}
