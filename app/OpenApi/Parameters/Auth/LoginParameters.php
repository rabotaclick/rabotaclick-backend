<?php

namespace App\OpenApi\Parameters\Auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class LoginParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('phone')
                ->description('Телефон исполнителя')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('code')
                ->description('Код')
                ->required(true)
                ->schema(Schema::integer()),
        ];
    }
}
