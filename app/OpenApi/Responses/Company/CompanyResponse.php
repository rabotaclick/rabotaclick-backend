<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Company;

use App\OpenApi\Schemas\CompanySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class CompanyResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(CompanySchema::ref())
        );
    }
}
