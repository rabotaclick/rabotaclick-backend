<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Vacancy;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class StoreResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('invoiceID')->example('string'),
            Schema::string('amount')->example('int'),
            Schema::object('user')->properties(
                Schema::string('id')->example('string'),
                Schema::string('email')->example('string'),
                Schema::string('phone')->example('string'),
                Schema::string('name')->example('string'),
                Schema::string('surname')->example('string'),
                Schema::string('lastname')->example('string'),
            )
        );
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema($response)
        );
    }
}
