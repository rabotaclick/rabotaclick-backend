<?php

namespace App\OpenApi\Responses\User;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class DeleteResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('deleted_at')->example('2024-01-18 18:16:17'),
        );
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema($response)
        );
    }
}
