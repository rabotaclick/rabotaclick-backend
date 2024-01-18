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

class UserSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('User')
            ->properties(
                Schema::object('data')->properties(
                    Schema::string('id')->default(null),
                    Schema::string('name')->default(null),
                    Schema::string('surname')->default(null),
                    Schema::string('lastname')->default(null),
                    Schema::string('phone')->default(null),
                    Schema::string('change_phone')->default(null),
                    Schema::string('email')->default(null),
                    Schema::string('change_email')->default(null),
                    Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                    Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                )
            );
    }
}
