<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Public;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class InvalidCredentialsResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Неверные данные'),
        );
        return Response::create('Неверные данные')
            ->description('Неверные данные')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
