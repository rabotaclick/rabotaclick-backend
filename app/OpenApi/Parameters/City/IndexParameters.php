<?php

namespace App\OpenApi\Parameters\City;

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
                ->name('letter')
                ->description('Поиск по букве')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
