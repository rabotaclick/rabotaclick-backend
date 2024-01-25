<?php

namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateWorkingHistoryParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('work_histories')
                ->description('Опыт работы')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::object("create")->properties(
                        Schema::string('start_date'),
                        Schema::string('end_date'),
                        Schema::string('organization'),
                        Schema::string('region_id'),
                        Schema::string('website_url'),
                        Schema::object('subspecializations')->properties(
                            Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                        ),
                        Schema::string('job'),
                        Schema::string('description')
                    ),
                    Schema::array("delete"),
                    Schema::object("update")->properties(
                        Schema::string("id"),
                        Schema::string('start_date'),
                        Schema::string('end_date'),
                        Schema::string('organization'),
                        Schema::string('region_id'),
                        Schema::string('website_url'),
                        Schema::object('subspecializations')->properties(
                            Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                        ),
                        Schema::string('job'),
                        Schema::string('description')
                    )
                )),
            Parameter::query()
                ->name('key_skills')
                ->description('Ключевые навыки')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::array("create"),
                    Schema::array("delete"),
                )),
            Parameter::query()
                ->name('about_me')
                ->description('О себе')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('have_car')
                ->description('Есть ли автомобиль')
                ->required(false)
                ->schema(Schema::boolean()),
            Parameter::query()
                ->name('driver_categories')
                ->description('Категории прав')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba'),
                )),

        ];
    }
}
