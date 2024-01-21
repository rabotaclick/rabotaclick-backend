<?php

namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateContactsParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('phone')
                ->description('Телефон')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('email')
                ->description('Почта')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('preferred_contact')
                ->description('Желаемый вид связи')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
