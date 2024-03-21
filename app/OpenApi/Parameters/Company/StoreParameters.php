<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Company;

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
                ->name('type')
                ->description('Тип организации: individual, project, person, self-employed, recruiter, agency')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('name')
                ->description('Название организации')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('city_id')
                ->description('Город')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('website')
                ->description('Вебсайт организации')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('specialization_id')
                ->description('Специализация')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('phone')
                ->description('Телефон')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('description')
                ->description('Описание')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('document')
                ->description('Файл с документом')
                ->required(false)
                ->schema(Schema::object()),

        ];
    }
}
