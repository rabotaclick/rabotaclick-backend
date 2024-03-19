<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Vacancy\VacancyResponse;
use App\Presenters\Vacancy\VacancyPresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Vacancy\ShowUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ShowController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private ShowUseCase $useCase,
        private VacancyPresenter $presenter
    )
    {
    }
    /**
     * Получение вакансии
     *
     * Получение вакансии по ID.
     */
    #[OpenApi\Operation(tags: ['Vacancy'], method: 'GET')]
    #[OpenApi\Response(VacancyResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(string $id)
    {
        $this->validateVacancyId($id);

        $responseDTO = $this->useCase->execute($id);

        return $this->presenter->present($responseDTO);
    }
}
