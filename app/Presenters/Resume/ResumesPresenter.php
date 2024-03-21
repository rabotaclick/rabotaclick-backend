<?php declare(strict_types=1);
namespace App\Presenters\Resume;

use App\DTO\Resume\IndexResponseDTO;
use App\Http\Resources\Resume\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResumesPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->resumes)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->resumes->total())
            ->setStatusCode(Response::HTTP_OK);
    }
}
