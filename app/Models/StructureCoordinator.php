<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StructureCoordinator extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    static public function promotersList()
    {
        return StructureCoordinator::select('structure_coordinators.id', 'members.firstname', 'members.lastname', 'electoral_key', 'structure_coordinators.section', 'structure_coordinators.goal')
        ->join('members', 'members.id', '=', 'structure_coordinators.member_id')
        ->where('structure_coordinators.position_id', 5)->orderBy('structure_coordinators.id')->orderBy('id', 'desc')
        ;
    }
}
