<?php declare(strict_types=1);
namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class CitySchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('City')
            ->properties(
                Schema::string('id')->default(null),
                Schema::string('name')->default(null),
                Schema::object('region')->properties(
                    Schema::string('id')->default(null),
                    Schema::string('name')->default(null),
                    Schema::object('country')->properties(
                        Schema::string('id')->default(null),
                        Schema::string('name')->example('Россия')
                    )
                )
            );
    }
}
