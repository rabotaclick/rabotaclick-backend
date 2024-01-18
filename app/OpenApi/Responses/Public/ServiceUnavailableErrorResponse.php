<?php

namespace App\OpenApi\Responses\Public;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ServiceUnavailableErrorResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Сервис временно недоступен'),
        );
        return Response::create('Сервис недоступен')
            ->description('Ошибка на стороне бэкэнда')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
