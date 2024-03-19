<?php

namespace App\DTO\Vacancy;

use App\Models\City;
use App\Traits\FilterDataTrait;
use Illuminate\Database\Eloquent\Collection;

readonly class StoreRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string           $title,
        public string           $salary_type,
        public int              $salary_from,
        public int              $salary_to,
        public string           $work_experience,
        public string           $occupation,
        public bool             $gpc,
        public string           $work_type,
        public string           $schedule,
        public Collection       $subspecializations,
        public Collection|null  $key_skills = null,
        public City             $city,
        public string           $responsibilities,
        public string           $requirements,
        public string           $conditions,
        public string           $education,

        public string           $contact_name,
        public string           $contact_surname,
        public string           $contact_lastname,
        public string           $contact_phone,
        public string           $contact_email,
        public string           $letter,

        public string           $vacancy_type
    )
    {
    }

    public function toArray()
    {
        $data = [
            "title" => $this->title,
            "salary_type" => $this->salary_type,
            "salary_from" => $this->salary_from,
            "salary_to" => $this->salary_to,
            "work_experience" => $this->work_experience,
            "occupation" => $this->occupation,
            "gpc" => $this->gpc,
            "work_type" => $this->work_type,
            "schedule" => $this->schedule,
            "city_id" => $this->city->id,
            "responsibilities" => $this->responsibilities,
            "requirements" => $this->requirements,
            "conditions" => $this->conditions,
            "education" => $this->education,
            "contact_name" => $this->contact_name,
            "contact_surname" => $this->contact_surname,
            "contact_lastname" => $this->contact_lastname,
            "contact_phone" => $this->contact_phone,
            "contact_email" => $this->contact_email,
            "letter" => $this->letter,
        ];

        return $this->filterData($data);
    }
}
