<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function structureCoordinators(): HasMany
    {
        return $this->hasMany(StructureCoordinator::class);
    }

    public function structurePromoteds(): HasMany
    {
        return $this->hasMany(StructurePromoted::class);
    }
}
