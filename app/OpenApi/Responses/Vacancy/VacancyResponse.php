<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Vacancy;

use App\OpenApi\Schemas\VacancySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class VacancyResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(VacancySchema::ref())
        );
    }
}
