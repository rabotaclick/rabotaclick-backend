<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Vacancy;

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
                Schema::string("created_at"),
                Schema::string("title"),
                Schema::string("salary_from"),
                Schema::string("salary_to"),
                Schema::object("company")->properties(
                    Schema::string("id"),
                    Schema::string("name"),
                    Schema::string("website"),
                    Schema::string("photo"),
                ),
                Schema::integer("work_experience"),
            ))
        );
    }
}
