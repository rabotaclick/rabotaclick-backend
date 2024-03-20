<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\Vacancy\IndexParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Vacancy\IndexResponse;
use App\Presenters\Vacancy\VacanciesPresenter;
use App\UseCases\Vacancy\IndexUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private VacanciesPresenter $presenter
    )
    {
    }
    /**
     * Поиск вакансий
     *
     * Поиск вакансий с фильтрами.
     */
    #[OpenApi\Operation(tags: ['Vacancy'], method: 'POST')]
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
