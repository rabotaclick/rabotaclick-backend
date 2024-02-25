<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\OpenApi\Parameters\Auth\RegisterParameters;
use App\OpenApi\Responses\Auth\RegisterAlreadyResponse;
use App\OpenApi\Responses\Public\RegisterResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\User\UserPresenter;
use App\UseCases\Auth\RegisterUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class RegisterController extends Controller
{
    public function __construct(
        private RegisterUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }
    /**
     * Последний этап регистрации
     *
     * Задает пользователю Имя и Фамилию.
     */
    #[OpenApi\Operation(tags: ['Applicant'], security: 'BearerToken', method: 'POST')]
    #[OpenApi\Parameters(RegisterParameters::class)]
    #[OpenApi\Response(RegisterResponse::class, 200)]
    #[OpenApi\Response(RegisterAlreadyResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(RegisterRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
