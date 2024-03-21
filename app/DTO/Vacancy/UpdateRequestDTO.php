<?php declare(strict_types=1);

namespace App\DTO\Vacancy;

use App\Models\City;
use App\Traits\FilterDataTrait;
use Illuminate\Database\Eloquent\Collection;

readonly class UpdateRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null           $title = null,
        public string|null           $salary_type = null,
        public int|null              $salary_from = null,
        public int|null              $salary_to = null,
        public string|null           $work_experience = null,
        public string|null           $occupation = null,
        public bool|null             $gpc = null,
        public string|null           $work_type = null,
        public string|null           $schedule = null,
        public Collection|null       $subspecializations = null,
        public Collection|null       $key_skills = null,
        public City|null             $city = null,
        public string|null           $responsibilities = null,
        public string|null           $requirements = null,
        public string|null           $conditions = null,
        public string|null           $education = null,

        public string|null           $contact_name = null,
        public string|null           $contact_surname = null,
        public string|null           $contact_lastname = null,
        public string|null           $contact_phone = null,
        public string|null           $contact_email = null,
        public string|null           $letter = null
    )
    {
    }

    public function toArray(): array
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
