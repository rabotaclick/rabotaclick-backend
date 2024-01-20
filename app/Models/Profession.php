<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profession extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'professions';

    protected $guarded = [
        'id'
    ];

    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'profession_subspecializations');
    }
}
