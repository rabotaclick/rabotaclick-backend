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

class ResumeSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Resume')
            ->properties(
                Schema::string('id')->default(null),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('deleted_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('profession')->default(null),
                Schema::string('surname')->default(null),
                Schema::string('name')->default(null),
                Schema::string('lastname')->default(null),
                Schema::string('birthdate')->format(Schema::FORMAT_DATE)->default(null),
                Schema::integer('salary')->default(0),
                Schema::boolean('have_car')->default(null),
                Schema::string('about_me')->default(null),
                Schema::string('phone')->default(null),
                Schema::string('email')->default(null),
                Schema::string('preferred_contact')->default(null),
                Schema::string('gender')->default(null),
                Schema::string('ready_to_move')->default(null),
                Schema::string('business_trips')->default(null),
                Schema::string('occupation')->default(null),
                Schema::string('schedule')->default(null),
                Schema::string('travel_time')->default(null),
                Schema::string('main_language_id')->default(null),
                Schema::string('city_id')->default(null),
                Schema::string('citizenship_country_id')->default(null),
                Schema::string('work_permit_country_id')->default(null),
                Schema::string('user_id')->default(null)
            );
    }
}
