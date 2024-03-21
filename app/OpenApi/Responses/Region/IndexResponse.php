<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Region;

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
                Schema::string('id'),
                Schema::string('name'),
                Schema::object('country')->properties(
                    Schema::string('id'),
                    Schema::string('name'),
                )
            ))
        );
    }
}
