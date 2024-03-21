<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Public;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class UnauthoraizedResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('У вас нету доступа'),
        );
        return Response::unauthorized()->description('У вас нету доступа')->content(
            MediaType::json()->schema($response)
        );
    }
}
