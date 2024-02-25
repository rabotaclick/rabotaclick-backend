<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Contracts\UpdateRequestInterface;
use App\OpenApi\Parameters\Company\UpdateParameters;
use App\OpenApi\Responses\Company\CompanyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Company\CompanyPresenter;
use App\UseCases\Company\UpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdateController extends Controller
{
    public function __construct(
        private UpdateUseCase $useCase,
        private CompanyPresenter $presenter,
    )
    {
    }
    /**
     * Обновление компании
     *
     * Обновление компании.
     */
    #[OpenApi\Operation(tags: ['Company'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateParameters::class)]
    #[OpenApi\Response(CompanyResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
