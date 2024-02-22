<?php

namespace App\OpenApi\Parameters\Auth\Employer;

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
                ->name('email')
                ->description('Почта пользователя')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('password')
                ->description('Пароль пользователя')
                ->required(true)
                ->schema(Schema::string()),

        ];
    }
}
