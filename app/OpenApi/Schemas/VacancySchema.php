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

class VacancySchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('Vacancy')
            ->properties(
                Schema::string('id')->default(null),
                Schema::string('created_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('updated_at')->format(Schema::FORMAT_DATE_TIME)->default(null),
                Schema::string('title')->default(null),
                Schema::integer('salary_from')->default(0),
                Schema::integer('salary_to')->default(null),
                Schema::boolean('gpc')->default(null),
                Schema::string('responsibilities')->default(null),
                Schema::string('requirements')->default(null),
                Schema::string('conditions')->default(null),
                Schema::string('salary_type')->default(null),
                Schema::string('work_experience')->default(null),
                Schema::string('occupation')->default(null),
                Schema::string('work_type')->default(null),
                Schema::string('schedule')->default(null),
                Schema::string('education')->default(null),
                Schema::string('contact_name')->default(null),
                Schema::string('contact_surname')->default(null),
                Schema::string('contact_lastname')->default(null),
                Schema::string('contact_phone')->default(null),
                Schema::string('contact_email')->default(null),
                Schema::string('letter')->default(null),
                Schema::boolean('is_active')->default(''),
                Schema::string('city_id')->default(null),
                Schema::string('company_id')->default(null)
            );
    }
}
