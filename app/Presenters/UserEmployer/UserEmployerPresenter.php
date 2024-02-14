<?php

namespace App\Presenters\UserEmployer;

use App\DTO\UserEmployer\UserEmployerDTO;
use App\Http\Resources\UserEmployer\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserEmployerPresenter
{
    public function present(UserEmployerDTO $responseDTO): JsonResponse
    {
        return (new Resource($responseDTO->userEmployer))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
