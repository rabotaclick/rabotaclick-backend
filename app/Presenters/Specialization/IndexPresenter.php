<?php

namespace App\Presenters\Specialization;

use App\DTO\Specialization\IndexResponseDTO;
use App\Http\Resources\Specialization\IndexResource;
use App\Http\Resources\Specialization\IndexResourceSubspecializations;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        if($responseDTO->withSubspecializations) {
            return IndexResourceSubspecializations::collection($responseDTO->collection)
                ->response()
                ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
                ->setStatusCode(Response::HTTP_OK);
        } else {
            return IndexResource::collection($responseDTO->collection)
                ->response()
                ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
                ->setStatusCode(Response::HTTP_OK);
        }
    }
}
