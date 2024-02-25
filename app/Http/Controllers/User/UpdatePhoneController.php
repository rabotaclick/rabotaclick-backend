<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface;
use App\OpenApi\Parameters\User\UpdatePhoneParameters;
use App\OpenApi\Responses\Public\LoginNotFoundResponse;
use App\OpenApi\Responses\Public\RegisterResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\UpdatePhoneUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdatePhoneController extends Controller
{
    public function __construct(
        private UpdatePhoneUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }
    /**
     * Обновление телефона пользователя
     *
     * Обновление телефона пользователя, после обновление телефона.
     */
    #[OpenApi\Operation(tags: ['User'], security: BearerToken::class ,method: 'PUT')]
    #[OpenApi\Parameters(UpdatePhoneParameters::class)]
    #[OpenApi\Response(RegisterResponse::class, 200)]
    #[OpenApi\Response(LoginNotFoundResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdatePhoneRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
