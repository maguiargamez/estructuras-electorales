<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElectionType extends Model
{
    use HasFactory;

    public function elections(): HasMany
    {
        return $this->hasMany(Election::class);
    }
}
