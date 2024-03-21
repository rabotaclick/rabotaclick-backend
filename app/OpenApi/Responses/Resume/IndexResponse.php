<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class IndexResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(Schema::object('data')->properties(
                Schema::string("id"),
                Schema::string("profession"),
                Schema::string("birthdate"),
                Schema::string("updated_at"),
                Schema::string("salary"),
                Schema::object("user")->properties(
                    Schema::string("status")
                ),
                Schema::integer("work_experience"),
                Schema::object('last_work')->properties(
                    Schema::string("id"),
                    Schema::string("organization"),
                    Schema::string("website_url"),
                    Schema::string("description"),
                    Schema::string("start_date"),
                    Schema::string("end_date"),
                    Schema::string("region_id"),
                    Schema::string("resume_id"),
                )
            ))
        );
    }
}
