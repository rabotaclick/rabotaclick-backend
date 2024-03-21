<?php

namespace App\OpenApi\Parameters\Vacancy;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('title')
                ->description('Название')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('salary_type')
                ->description('in_hand, before_taxes')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('salary_from')
                ->description('зарплата от')
                ->required(false)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('salary_to')
                ->description('зарплата до')
                ->required(false)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('work_experience')
                ->description('zero, one_to_three, three_to_six, more_than_six')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('occupation')
                ->description('full-time, part-time, project, volunteer, internship')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('gpc')
                ->description('гпх по совместительству')
                ->required(false)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('work_type')
                ->description('full_job, part_job')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('schedule')
                ->description('full, shift, flexible, remote, rotation')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('subspecializations')
                ->description('массив айдишек')
                ->required(false)
                ->schema(Schema::array()),
            Parameter::query()
                ->name('key_skills')
                ->description('массив айдишек')
                ->required(false)
                ->schema(Schema::array()),
            Parameter::query()
                ->name('city_id')
                ->description('айди города')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('responsibilities')
                ->description('обязанности')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('requirements')
                ->description('требования')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('conditions')
                ->description('условия')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('education')
                ->description('not_required, high, college')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('contact_name')
                ->description('Имя контакта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('contact_surname')
                ->description('Фамилия контакта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('contact_lastname')
                ->description('Отчество контакта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('contact_phone')
                ->description('Телефон контакта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('contact_email')
                ->description('Почта контакта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('letter')
                ->description('Письмо приглашения')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
