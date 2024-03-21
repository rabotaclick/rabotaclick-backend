<?php declare(strict_types=1);
namespace App\Presenters\KeySkill;

use App\DTO\KeySkill\IndexResponseDTO;
use App\Http\Resources\KeySkill\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class KeySkillsPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(IndexResponseDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->key_skills)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
            ->setStatusCode(Response::HTTP_OK);
    }
}
