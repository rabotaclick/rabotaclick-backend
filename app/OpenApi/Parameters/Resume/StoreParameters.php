<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class StoreParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [
            Parameter::query()
                ->name('name')
                ->description('Имя')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('surname')
                ->description('Фамилия')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('lastname')
                ->description('Отчество')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('birthdate')
                ->description('Год рождения в формате Y-m-d')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('gender')
                ->description('Пол, male или female')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('city_id')
                ->description('uuid города')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('ready_to_move')
                ->description('Готовы ли к переезду?, yes, no, want')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('business_trips')
                ->description('Командировки, never, ready, sometimes')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('profession')
                ->description('Профессия')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('subspecializations')
                ->description('Массив под специализаций')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                )),
            Parameter::query()
                ->name('salary')
                ->description('Зарплата')
                ->required(true)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('occupation')
                ->description("Занятость,'full-time', 'part-time', 'project', 'volunteer', 'internship' ")
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('schedule')
                ->description("График, 'full', 'shift', 'flexible', 'remote', 'rotation'")
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('work_histories')
                ->description('Опыт работы')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string('start_date'),
                    Schema::string('end_date'),
                    Schema::string('organization'),
                    Schema::string('region_id'),
                    Schema::string('website_url'),
                    Schema::object('subspecializations')->properties(
                        Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                    ),
                    Schema::string('job'),
                    Schema::string('description')
                )),
            Parameter::query()
                ->name('key_skills')
                ->description('Ключевые навыки')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba'),
                )),
            Parameter::query()
                ->name('about_me')
                ->description('О себе')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('have_car')
                ->description('Есть ли автомобиль')
                ->required(true)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('driver_categories')
                ->description('Категории прав')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba'),
                )),
            Parameter::query()
                ->name('education_places')
                ->description('Образование')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string('education'),
                    Schema::string('name'),
                    Schema::string('faculty'),
                    Schema::string('specialization'),
                    Schema::string('year_of_ending'),
                )),
            Parameter::query()
                ->name('main_language_id')
                ->description('Родной язык')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('languages')
                ->description('Иностранные языки')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string('language_id'),
                    Schema::string('level'),
                )),
            Parameter::query()
                ->name('citizenship_country_id')
                ->description('Гражданство')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('work_permit_country_id')
                ->description('Разрешение на работу')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('travel_time')
                ->description("Время на работу, 'dontcare', 'hour', 'hourhalf'")
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('phone')
                ->description('Телефон')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('email')
                ->description('Почта')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('preferred_contact')
                ->description('Желаемый вид связи')
                ->required(true)
                ->schema(Schema::string()),
        ];
    }
}
