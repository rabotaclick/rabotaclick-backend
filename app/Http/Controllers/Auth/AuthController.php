<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\OpenApi\Parameters\Auth\AuthParameters;
use App\OpenApi\Responses\Auth\AuthResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Auth\AuthPresenter;
use App\UseCases\Auth\AuthUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class AuthController extends Controller
{
    public function __construct(
        private AuthUseCase $useCase,
        private AuthPresenter $presenter,
    )
    {
    }
    /**
     * Получение кода на телефон
     *
     * Получает код на телефон для дальнейшей регистрации, есть ограничение 1 запрос в минуту.
     */
    #[OpenApi\Operation(tags: ['Applicant'], method: 'POST')]
    #[OpenApi\Parameters(factory: AuthParameters::class)]
    #[OpenApi\Response(factory: AuthResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ServiceUnavailableErrorResponse::class, statusCode: 503)]
    public function __invoke(AuthRequestInterface $request): mixed
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
