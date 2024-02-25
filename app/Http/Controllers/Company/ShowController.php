<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Company\CompanyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Company\GuestCompanyPresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Company\ShowUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class ShowController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private ShowUseCase $useCase,
        private GuestCompanyPresenter $presenter,
    )
    {
    }
    /**
     * Получение компании
     *
     * Получение компании.
     */
    #[OpenApi\Operation(tags: ['Company'], method: 'GET')]
    #[OpenApi\Response(CompanyResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(string $id): JsonResponse
    {
        $this->validateCompanyId($id);

        $responseDTO = $this->useCase->execute($id);

        return $this->presenter->present($responseDTO);
    }
}
