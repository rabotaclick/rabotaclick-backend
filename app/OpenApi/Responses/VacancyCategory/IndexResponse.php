<?php

namespace App\OpenApi\Responses\VacancyCategory;

use App\OpenApi\Schemas\VacancyCategorySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class IndexResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(VacancyCategorySchema::ref())
        );
    }
}
