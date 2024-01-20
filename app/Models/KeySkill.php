<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KeySkill extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'key_skills';

    protected $guarded = [
        'id'
    ];

    public function resume(): BelongsToMany
    {
        return $this->belongsToMany(Resume::class, 'resume_key_skills');
    }
}
