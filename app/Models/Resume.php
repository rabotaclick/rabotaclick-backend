<?php

namespace App\Models;

use App\Pivots\Language\LevelPivot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'resumes';

    protected $guarded = [
        'id'
    ];
    protected $appends = [
        'work_experience',
        'last_work'
    ];
    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'resume_subspecializations');
    }

    public function driver_categories(): BelongsToMany
    {
        return $this->belongsToMany(DriverCategory::class, 'resume_driver_categories');
    }
    public function main_language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'main_language_id', 'id');
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'resume_languages')
            ->withPivot('level');
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

    public function getWorkExperienceAttribute()
    {
        $allMonths = collect();

        foreach ($this->work_histories as $workHistory) {
            $startDate = Carbon::parse($workHistory->start_date);
            $endDate = ($workHistory->end_date === null) ? Carbon::now() : Carbon::parse($workHistory->end_date);

            $currentDate = $startDate->copy();
            while ($currentDate->lessThanOrEqualTo($endDate)) {
                $allMonths->put($currentDate->format('Y-m'), true);
                $currentDate->addMonth();
            }
        }

        return $this->formatMonths($allMonths->count());
    }

    private function formatMonths($months)
    {
        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        $result = [];

        if ($years > 0) {
            $result[] = ($years > 1) ? "$years года" : "1 год";
        }

        if ($remainingMonths > 0) {
            $result[] = ($remainingMonths === 1) ? "1 месяц" : (
            ($remainingMonths >= 2 && $remainingMonths <= 4) ? "$remainingMonths месяца" : "$remainingMonths месяцев"
            );
        }

        return implode(', ', $result);
    }

    public function getLastWorkAttribute()
    {
        return $this->work_histories()->where('end_date','=',null)->first() ??
            $this->work_histories()->orderBy('end_date', 'DESC')->first();

    }
}
