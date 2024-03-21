<?php declare(strict_types=1);
namespace App\Presenters\Vacancy;

use App\DTO\Vacancy\IndexResponseDTO;
use App\Http\Resources\Vacancy\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VacanciesPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->vacancies)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->vacancies->total())
            ->setStatusCode(Response::HTTP_OK);
    }
}
