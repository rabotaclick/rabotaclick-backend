<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'languages';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function resumes(): BelongsToMany
    {
        return $this->belongsToMany(Resume::class, "resume_languages");
    }
}
