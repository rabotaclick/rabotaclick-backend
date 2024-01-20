<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\StoreRequest;
use App\OpenApi\Parameters\Resume\StoreParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\Responses\Resume\TooManyResumesResponse;
use App\OpenApi\Schemas\ResumeSchema;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\UseCases\Resume\StoreUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class StoreController extends Controller
{
    public function __construct(
        private StoreUseCase $useCase,
        private ResumePresenter $presenter,
    )
    {
    }
    /**
     * Создание резюме
     *
     * Создание резюме для пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'POST')]
    #[OpenApi\Parameters(StoreParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(TooManyResumesResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(StoreRequest $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
