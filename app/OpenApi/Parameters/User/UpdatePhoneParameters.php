<?php

namespace App\OpenApi\Parameters\User;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdatePhoneParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('code')
                ->description('4-х значный код')
                ->required(true)
                ->schema(Schema::integer()),

        ];
    }
}
