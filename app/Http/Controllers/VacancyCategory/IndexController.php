<?php

namespace App\Http\Controllers\VacancyCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyCategory\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\VacancyCategory\IndexParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\VacancyCategory\IndexResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\VacancyCategory\IndexPresenter;
use App\UseCases\VacancyCategory\IndexUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]

class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private IndexPresenter $presenter
    )
    {
    }
    /**
     * Получение категорий вакансий
     *
     * Получение категорий вакансий с пагинацией и сортировкой.
     */
    #[OpenApi\Operation(tags: ['VacancyCategory'] ,method: 'GET')]
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
