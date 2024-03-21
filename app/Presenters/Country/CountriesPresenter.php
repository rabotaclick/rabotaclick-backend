<?php declare(strict_types=1);
namespace App\Presenters\Country;

use App\DTO\Country\CountriesDTO;
use App\Http\Resources\Country\IndexResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CountriesPresenter
{
    public const HEADER_X_TOTAL_COUNT = 'X-Total-Count';
    public function present(CountriesDTO $responseDTO): JsonResponse
    {
        return IndexResource::collection($responseDTO->countries)
            ->response()
            ->header(self::HEADER_X_TOTAL_COUNT, $responseDTO->totalRowCount)
            ->setStatusCode(Response::HTTP_OK);
    }
}
