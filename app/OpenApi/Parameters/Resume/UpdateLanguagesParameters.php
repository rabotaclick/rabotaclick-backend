<?php

namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateLanguagesParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('main_language_id')
                ->description('Родной язык')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('languages')
                ->description('Иностранные языки')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::object("manipulate")->properties(
                        Schema::string('language_id'),
                        Schema::string('level'),
                    ),
                    Schema::array("delete")->items(
                        Schema::string()
                    )
                )),

        ];
    }
}
