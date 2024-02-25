<?php

namespace App\Http\Controllers\SubSpecialization;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubSpecialization\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\SubSpecialization\IndexParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\SubSpecialization\IndexResponse;
use App\Presenters\SubSpecialization\IndexPresenter;
use App\UseCases\SubSpecialization\IndexUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private IndexPresenter $presenter,
    )
    {
    }
    /**
     * Получение подспециализаций
     *
     * Получение подспециализаций с поиском.
     */
    #[OpenApi\Operation(tags: ['Specialization'] ,method: 'GET')]
    #[OpenApi\Parameters(IndexParameters::class)]
    #[OpenApi\Response(IndexResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(IndexRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
