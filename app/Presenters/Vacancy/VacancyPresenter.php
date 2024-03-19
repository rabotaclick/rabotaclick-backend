<?php

namespace App\Presenters\Vacancy;

use App\DTO\Vacancy\VacancyDTO;
use App\Http\Resources\Vacancy\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VacancyPresenter
{
    public function present(VacancyDTO $responseDTO): JsonResponse
    {
        return (new Resource($responseDTO->vacancy))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
