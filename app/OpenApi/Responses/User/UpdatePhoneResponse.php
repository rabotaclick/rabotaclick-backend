<?php declare(strict_types=1);
namespace App\OpenApi\Responses\User;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class UpdatePhoneResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('phone')->example('+79243609722'),
        );
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema($response)
        );
    }
}
