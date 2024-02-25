<?php

namespace App\Http\Controllers\UserEmployer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEmployer\Contracts\UpdateRequestInterface;
use App\OpenApi\Parameters\UserEmployer\UpdateParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\UserEmployer\InvalidPasswordResponse;
use App\OpenApi\Responses\UserEmployer\UserEmployerResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\UserEmployer\UserEmployerPresenter;
use App\UseCases\UserEmployer\UpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdateController extends Controller
{
    public function __construct(
        private UpdateUseCase $useCase,
        private UserEmployerPresenter $presenter,
    )
    {
    }
    /**
     * Обновление пользователя
     *
     * Обновление пользователя.
     */
    #[OpenApi\Operation(tags: ['UserEmployer'], security: BearerToken::class ,method: 'PUT')]
    #[OpenApi\Parameters(UpdateParameters::class)]
    #[OpenApi\Response(UserEmployerResponse::class, 200)]
    #[OpenApi\Response(InvalidPasswordResponse::class, 401)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
