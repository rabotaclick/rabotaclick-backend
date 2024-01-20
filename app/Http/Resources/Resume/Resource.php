<?php

namespace App\Http\Resources\Resume;

use App\Http\Resources\Resume\Enums\ResourceEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ResourceEnum::Id->value => $this->id,
            ResourceEnum::CreatedAt->value => $this->created_at,
            ResourceEnum::UpdatedAt->value => $this->updated_at,
            ResourceEnum::Name->value => $this->name,
            ResourceEnum::Surname->value => $this->surname,
            ResourceEnum::Lastname->value => $this->lastname,
            ResourceEnum::Birthdate->value => $this->birthdate,
            ResourceEnum::Salary->value => $this->salary,
            ResourceEnum::HaveCar->value => $this->have_car,
            ResourceEnum::AboutMe->value => $this->about_me,
            ResourceEnum::Phone->value => $this->phone,
            ResourceEnum::Email->value => $this->email,
            ResourceEnum::PreferredContact->value => $this->preferred_contact,
            ResourceEnum::Gender->value => $this->gender,
            ResourceEnum::ReadyToMove->value => $this->ready_to_move,
            ResourceEnum::BusinessTrips->value => $this->business_trips,
            ResourceEnum::Profession->value => $this->profession,
            ResourceEnum::Occupation->value => $this->occupation,
            ResourceEnum::Schedule->value => $this->schedule,
            ResourceEnum::TravelTime->value => $this->travel_time,
            ResourceEnum::MainLanguage->value => $this->main_language
                ->makeHidden('id'),
            ResourceEnum::City->value => $this->city
                ->makeHidden('id'),
            ResourceEnum::CitizenshipCountry->value => $this->citizenship
                ->makeHidden('id'),
            ResourceEnum::WorkPermitCountry->value => $this->work_permit
                ->makeHidden('id'),
            ResourceEnum::User->value => $this->user()
                ->select(['id','name','surname','lastname'])
                ->first(),
            ResourceEnum::WorkHistories->value => $this->work_histories()
                ->with(['region',
                    'region.country'])
                ->get()
                ->makeHidden(['id','resume_id','region_id']),
            ResourceEnum::KeySkills->value => $this->key_skills
                ->makeHidden(['id','pivot']),
            ResourceEnum::DriverCategories->value => $this->driver_categories
                ->makeHidden(['id','pivot']),
            ResourceEnum::EducationPlaces->value => $this->education_places
                ->makeHidden(['id','resume_id']),
            ResourceEnum::Languages->value => $this->languages
                ->makeHidden(['id']),
            ResourceEnum::Subspecializations->value => $this->subspecializations
                ->makeHidden(['id','pivot','specialization_id']),
        ];
    }
}
