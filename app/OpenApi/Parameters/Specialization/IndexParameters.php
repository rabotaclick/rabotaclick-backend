<?php

namespace App\OpenApi\Parameters\Specialization;

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
                ->name('orderBy')
                ->description('Порядок сортировки ASC или DESC используется вместе с column')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('column')
                ->description('Сортировка по колонке')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
