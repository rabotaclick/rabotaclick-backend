<?php

namespace App\OpenApi\Responses\Company;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class CompanyNotCreatedResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Вы еще не создали компанию'),
        );
        return Response::unprocessableEntity()->description('Вы еще не создали компанию')->content(
            MediaType::json()->schema($response)
        );
    }
}
