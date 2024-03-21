<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Public;

use App\OpenApi\Schemas\UserSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class RegisterResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(UserSchema::ref())
        );
    }
}
