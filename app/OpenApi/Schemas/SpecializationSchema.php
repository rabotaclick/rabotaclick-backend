<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class SpecializationSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Specialization')
            ->properties(
                Schema::object('data')->properties(
                    Schema::string('id')->default(null),
                    Schema::string('title')->default(null),
                    Schema::integer('vacancies')->default(null)
                ),
                Schema::object('links')->properties(
                    Schema::string('first')->example("http://localhost:8000/api/v1/vacancy/categories?first=15&page=1"),
                    Schema::string('last')->example("http://localhost:8000/api/v1/vacancy/categories?first=15&page=2"),
                    Schema::string('prev')->example(null),
                    Schema::string('next')->example("http://localhost:8000/api/v1/vacancy/categories?first=15&page=2"),
                ),
                Schema::object('meta')->properties(
                    Schema::integer('current_page')->example(1),
                    Schema::integer('from')->example(1),
                    Schema::integer('last_page')->example(2),
                    Schema::object('links')->properties(
                        Schema::string('url')->example("http://localhost:8000/api/v1/vacancy/categories?first=15&page=1"),
                        Schema::integer('label')->example(1),
                        Schema::boolean('active')->example(true)
                    ),
                    Schema::string('path')->example('http://localhost:8000/api/v1/vacancy/categories'),
                    Schema::integer('per_page')->example(15),
                    Schema::integer('to')->example(15),
                    Schema::integer('total')->example(29)
                )
            );
    }
}
