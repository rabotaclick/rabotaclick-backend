<?php declare(strict_types=1);
namespace App\Presenters\Company;

use App\DTO\Company\CompanyDTO;
use App\Http\Resources\Company\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyPresenter
{
    public function present(CompanyDTO $responseDTO): JsonResponse
    {
        return (new Resource($responseDTO->company))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
