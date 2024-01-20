<?php

namespace App\OpenApi\Responses\Resume;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class TooManyResumesResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('У вас максимальное количество резюме'),
        );
        return Response::unprocessableEntity()->description('У вас максимальное количество резюме')->content(
            MediaType::json()->schema($response)
        );
    }
}
