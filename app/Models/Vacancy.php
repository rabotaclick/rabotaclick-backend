<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'vacancies';

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'type'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'vacancy_subspecializations');
    }

    public function key_skills(): BelongsToMany
    {
        return $this->belongsToMany(KeySkill::class, 'vacancy_key_skills');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(VacancyPayment::class, 'vacancy_id', 'id');
    }

    public function payment(): mixed
    {
        foreach ($this->payments as $payment) {
            if(
                $payment->status == 'completed' &&
                Carbon::parse($payment->payed_at)->addDays(30) >= now()
            ) {
                return $payment;
            }
        }
        return null;
    }

    public function getTypeAttribute()
    {
        return $this->payment()->vacancy_type ?? null;
    }
}
