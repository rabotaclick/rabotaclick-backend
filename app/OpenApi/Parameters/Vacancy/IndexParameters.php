<?php

namespace App\OpenApi\Parameters\Vacancy;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class IndexParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('first')
                ->description('Количество возвращаемых обьектов')
                ->required(true)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('page')
                ->description('Страница')
                ->required(false)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('search')
                ->description('Поиск по названию')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('orderBy')
                ->description('Порядок сортировки asc или desc используется вместе с column')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('column')
                ->description('Сортировка по колонке')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('date')
                ->description('Сортировка по дате обновления day, three_days, week, month, year')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('city_id')
                ->description('uuid города')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('occupation')
                ->description("Занятость,'full-time', 'part-time', 'project', 'volunteer', 'internship' ")
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('schedule')
                ->description("График, 'full', 'shift', 'flexible', 'remote', 'rotation'")
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('work_experience')
                ->description("Опыт работы, 'zero', 'one_to_three', 'three_to_six', 'more_than_six'")
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('salary')
                ->description('Зарплата в string 10000, 50000, 100000, 150000, 200000 ')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('isset_salary')
                ->description('Указана зарплата')
                ->required(false)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('education')
                ->description('Уровень учебы not_required, high, college')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
