<?php

namespace App\Presenters\Storage;

use App\DTO\Storage\PutManyResponseDTO;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UrlsPresenter
{
    public function present(PutManyResponseDTO $responseDTO): JsonResponse
    {
        return response()
            ->json([
                "urls" => $responseDTO->urls
            ])
            ->setStatusCode(Response::HTTP_OK);
    }
}
