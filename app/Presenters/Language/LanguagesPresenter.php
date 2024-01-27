<?php

namespace App\Presenters\Language;

use App\DTO\Language\IndexResponseDTO;
use App\Http\Resources\Language\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LanguagesPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->languages)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
            ->setStatusCode(Response::HTTP_OK);
    }
}
