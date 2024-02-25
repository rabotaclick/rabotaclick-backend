<?php

namespace App\Presenters\Company;

use App\DTO\Company\CompanyDTO;
use App\Http\Resources\Company\GuestResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GuestCompanyPresenter
{
    public function present(CompanyDTO $responseDTO): JsonResponse
    {
        return (new GuestResource($responseDTO->company))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
