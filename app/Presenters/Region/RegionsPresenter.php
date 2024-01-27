<?php

namespace App\Presenters\Region;

use App\DTO\Region\IndexRequestDTO;
use App\DTO\Region\IndexResponseDTO;
use App\Http\Resources\Region\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegionsPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->regions)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
            ->setStatusCode(Response::HTTP_OK);
    }
}
