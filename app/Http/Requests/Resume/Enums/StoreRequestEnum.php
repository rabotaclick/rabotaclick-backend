<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum StoreRequestEnum: string implements RequestParamEnumInterface
{
    case Surname = 'surname';
    case Name = 'name';
    case Lastname = 'lastname';
    case Birthdate = 'birthdate';
    case Gender = 'gender';
    case CityId = 'city_id';
    case ReadyToMove = 'ready_to_move';
    case BusinessTrips = 'business_trips';
    case Profession = 'profession';
    case Subspecializations = 'subspecializations';
    case Salary = 'salary';
    case Occupation = 'occupation';
    case Schedule = 'schedule';
    case WorkHistories = 'work_histories';
    case KeySkills = 'key_skills';
    case AboutMe = 'about_me';
    case HaveCar = 'have_car';
    case DriverCategories = 'driver_categories';
    case EducationPlaces = 'education_places';
    case MainLanguageId = 'main_language_id';
    case Languages = 'languages';
    case CitizenshipCountryId = 'citizenship_country_id';
    case WorkPermitCountryId = 'work_permit_country_id';
    case TravelTime = 'travel_time';
    case Phone = 'phone';
    case Email = 'email';
    case PreferredContact = 'preferred_contact';
}
