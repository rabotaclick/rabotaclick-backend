<?php

namespace App\OpenApi\Parameters\Language;

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
                ->name('search')
                ->description('Поиск')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
