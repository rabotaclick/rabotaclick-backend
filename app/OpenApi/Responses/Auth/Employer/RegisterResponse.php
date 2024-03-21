<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Auth\Employer;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class RegisterResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('email')->example('info@rabotaclick.pro')
        );
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema($response)
        );
    }
}
