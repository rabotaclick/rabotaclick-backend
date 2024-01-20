<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subspecialization extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'subspecializations';

    protected $guarded = [
        'id'
    ];

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function professions(): BelongsToMany
    {
        return $this->belongsToMany(Profession::class, 'profession_subspecializations');
    }
}
