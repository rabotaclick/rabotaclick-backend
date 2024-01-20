<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'resumes';

    protected $guarded = [
        'id'
    ];

    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'resume_subspecializations');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function citizenship(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'citizenship_country_id', 'id');
    }

    public function work_permit(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'work_permit_country_id', 'id');
    }

    public function key_skills(): BelongsToMany
    {
        return $this->belongsToMany(KeySkill::class, 'resume_key_skills');
    }

    public function education_places(): HasMany
    {
        return $this->hasMany(EducationPlace::class, "resume_id", "id");
    }

    public function work_histories(): HasMany
    {
        return $this->hasMany(WorkHistory::class, 'resume_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
