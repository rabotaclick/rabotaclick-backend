<?php declare(strict_types=1);
namespace App\OpenApi\Responses\UserEmployer;

use App\OpenApi\Schemas\UserEmployerSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class UserEmployerResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(UserEmployerSchema::ref())
        );
    }
}
