<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Storage;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class PutResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::array("urls")->items(
                Schema::string()->example("https://example.url")
            )
        );
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema($response)
        );
    }
}
