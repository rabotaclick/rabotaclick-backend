<?php declare(strict_types=1);
namespace App\OpenApi\Responses\Resume;

use App\OpenApi\Schemas\ResumeSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ResumeResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Успешный запрос')->content(
            MediaType::json()->schema(ResumeSchema::ref())
        );
    }
}
