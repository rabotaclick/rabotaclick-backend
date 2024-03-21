<?php declare(strict_types=1);
namespace App\Presenters\SubSpecialization;

use App\DTO\SubSpecialization\IndexResponseDTO;
use App\Http\Resources\SubSpecialization\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->subspecializations)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
            ->setStatusCode(Response::HTTP_OK);
    }
}
