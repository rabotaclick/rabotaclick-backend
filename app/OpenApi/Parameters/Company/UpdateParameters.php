<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Company;

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
                ->name('name')
                ->description('Название')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('city_id')
                ->description('Айди города')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('website')
                ->description('Сайт')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('specialization_id')
                ->description('Айди специализации')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('phone')
                ->description('Телефон')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('description')
                ->description('Описание')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
