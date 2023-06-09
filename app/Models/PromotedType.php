<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromotedType extends Model
{
    use HasFactory;

    public function promoteds(): HasMany
    {
        return $this->hasMany(StructurePromoted::class);
    }
}
