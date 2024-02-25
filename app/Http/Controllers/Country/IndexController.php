<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Country\IndexResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Country\CountriesPresenter;
use App\UseCases\Country\IndexUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private CountriesPresenter $presenter,
    )
    {
    }

    /**
     * Получение стран
     *
     * Получение стран.
     */
    #[OpenApi\Operation(tags: ['Country'], method: 'GET')]
    #[OpenApi\Response(IndexResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(): JsonResponse
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
