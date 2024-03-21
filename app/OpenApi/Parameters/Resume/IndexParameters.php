<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Resume;

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
                ->name('ready_to_move')
                ->description('Готовы ли к переезду?, yes, no, want')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('work_history_subspecializations')
                ->description('Опыт работы в отрасли')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::array('subspecializations')->items(Schema::string()),
                    Schema::string('date')->description('all_time, year, three_years, six_years')
                )),
            Parameter::query()
                ->name('user_status')
                ->description('Статус пользователя active, considering, offered, already_got, not_looking')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('age')
                ->description('Возраст')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::integer('from'),
                    Schema::integer('to')
                )),
            Parameter::query()
                ->name('isset_age')
                ->description('Указан возраст')
                ->required(false)
                ->schema(Schema::boolean()),
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
                ->name('subspecializations')
                ->description('Специализации')
                ->required(false)
                ->schema(Schema::array()->items(Schema::string())),
            Parameter::query()
                ->name('gender')
                ->description('Пол male, female')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('isset_gender')
                ->description('Указан пол')
                ->required(false)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('salary')
                ->description('Зарплата')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::integer('from'),
                    Schema::integer('to')
                )),
            Parameter::query()
                ->name('isset_salary')
                ->description('Указана зарплата')
                ->required(false)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('education')
                ->description('Уровень учебы secondary, secondary_specialized, incomplete_higher, higher, bachelor, master, candidate, doctor')
                ->required(false)
                ->schema(Schema::string()),
        ];
    }
}
