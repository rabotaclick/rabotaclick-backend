<?php declare(strict_types=1);
namespace App\OpenApi\Responses\UserEmployer;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class InvalidPasswordResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Неверный пароль'),
        );
        return Response::unprocessableEntity()->description('Неверный пароль')->content(
            MediaType::json()->schema($response)
        );
    }
}
