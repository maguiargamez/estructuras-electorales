<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Election extends Model
{
    use HasFactory;

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query
                ->where('description', 'like', '%'.$term.'%');
        });
    }

    public function electionType(): BelongsTo
    {
        return $this->belongsTo(ElectionType::class);
    }
}
