<?php

namespace App\OpenApi\Responses\User;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class InvalidEmailErrorResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Новый электронный адрес совпадает со старым'),
        );
        return Response::unprocessableEntity()->description('Новый электронный адрес совпадает со старым')->content(
            MediaType::json()->schema($response)
        );
    }
}
