<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\City\IndexParameters;
use App\OpenApi\Responses\City\IndexResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\City\CityPresenter;
use App\UseCases\City\IndexUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private CityPresenter $presenter,
    )
    {
    }
    /**
     * Получение городов
     *
     * Получение городов с разными фильтрациями.
     */
    #[OpenApi\Operation(tags: ['City'], method: 'GET')]
    #[OpenApi\Parameters(IndexParameters::class)]
    #[OpenApi\Response(IndexResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(IndexRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
