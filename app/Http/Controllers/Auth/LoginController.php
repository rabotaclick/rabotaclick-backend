<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\OpenApi\Parameters\Auth\LoginParameters;
use App\OpenApi\Responses\Auth\LoginResponse;
use App\OpenApi\Responses\Public\LoginNotFoundResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Auth\LoginUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LoginController extends Controller
{
    public function __construct(
        private LoginUseCase $useCase,
        private TokenPresenter $presenter,
    )
    {
    }
    /**
     * Валидация кода и вход или регистрация пользователя
     *
     * Валидирует код и создает модель пользователя.
     */
    #[OpenApi\Operation(tags: ['Applicant'], method: 'POST')]
    #[OpenApi\Parameters(LoginParameters::class)]
    #[OpenApi\Response(LoginResponse::class, 200)]
    #[OpenApi\Response(LoginNotFoundResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(LoginRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
