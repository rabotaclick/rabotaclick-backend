<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdatePersonalParameters extends ParametersFactory
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
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('surname')
                ->description('Фамилия')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('lastname')
                ->description('Отчество')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('birthdate')
                ->description('Год рождения в формате Y-m-d')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('gender')
                ->description('Пол, male или female')
                ->required(false)
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
                ->name('business_trips')
                ->description('Командировки, never, ready, sometimes')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('citizenship_country_id')
                ->description('Гражданство')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('work_permit_country_id')
                ->description('Разрешение на работу')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
