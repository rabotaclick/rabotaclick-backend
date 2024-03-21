<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Specialization;

use App\OpenApi\Schemas\SpecializationSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class IndexResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(SpecializationSchema::ref())
        );
    }
}
