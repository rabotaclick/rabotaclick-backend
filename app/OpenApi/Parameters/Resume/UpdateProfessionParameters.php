<?php

namespace App\OpenApi\Parameters\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateProfessionParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('profession')
                ->description('Профессия')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('subspecializations')
                ->description('Массив под специализаций')
                ->required(false)
                ->schema(Schema::object()->properties(
                    Schema::object('add')->properties(
                        Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                    ),
                    Schema::object('remove')->properties(
                        Schema::string()->example('9b23bd59-fb8b-4999-a788-8a4cb927baba')
                    )
                )),
            Parameter::query()
                ->name('salary')
                ->description('Зарплата')
                ->required(false)
                ->schema(Schema::integer()),
            Parameter::query()
                ->name('occupation')
                ->description("Занятость,'full-time', 'part-time', 'project', 'volunteer', 'internship' ")
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('schedule')
                ->description("График, 'full', 'shift', 'flexible', 'remote', 'rotation'")
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('travel_time')
                ->description("Время на работу, 'dontcare', 'hour', 'hourhalf'")
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
