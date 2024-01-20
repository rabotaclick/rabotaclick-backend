<?php

namespace App\Http\Resources\Resume\Enums;

enum ResourceEnum: string
{
    case Id = 'id';
    case CreatedAt = 'created_at';
    case UpdatedAt = 'updated_at';
    case Surname = 'surname';
    case Name = 'name';
    case Lastname = 'lastname';
    case Birthdate = 'birthdate';
    case Salary = 'salary';
    case HaveCar = 'have_car';
    case AboutMe = 'about_me';
    case Phone = 'phone';
    case Email = 'email';
    case PreferredContact = 'preferred_contact';
    case Gender = 'gender';
    case ReadyToMove = 'ready_to_move';
    case BusinessTrips = 'business_trips';
    case Profession = 'profession';
    case Occupation = 'occupation';
    case Schedule = 'schedule';
    case TravelTime = 'travel_time';
    case MainLanguage = 'main_language';
    case City = 'city';
    case CitizenshipCountry = 'citizenship_country';
    case WorkPermitCountry = 'work_permit_country';
    case User = 'user';
    case WorkHistories = 'work_histories';
    case KeySkills = 'key_skills';
    case DriverCategories = 'driver_categories';
    case EducationPlaces = 'education_places';
    case Languages = 'languages';
    case Subspecializations = 'subspecializations';
}
