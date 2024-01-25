<?php

namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateEducationParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('education_places')
                ->description('Учебные заведения')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::object("create")->properties(
                        Schema::string('education'),
                        Schema::string('name'),
                        Schema::string('faculty'),
                        Schema::string('specialization'),
                        Schema::string('website_url'),
                        Schema::string('year_of_ending'),
                    ),
                    Schema::array("delete"),
                    Schema::object("update")->properties(
                        Schema::string("id"),
                        Schema::string('education'),
                        Schema::string('name'),
                        Schema::string('faculty'),
                        Schema::string('specialization'),
                        Schema::string('website_url'),
                        Schema::string('year_of_ending'),
                    )
                )),

        ];
    }
}
