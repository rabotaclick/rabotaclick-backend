<?php

namespace App\Http\Controllers\Auth\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Employer\Contracts\RegisterRequestInterface;
use App\OpenApi\Parameters\Auth\Employer\RegisterParameters;
use App\OpenApi\Responses\Auth\Employer\RegisterResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Auth\Employer\RegisterPresenter;
use App\UseCases\Auth\Employer\RegisterUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class RegisterController extends Controller
{
    public function __construct(
        private RegisterUseCase $useCase,
        private RegisterPresenter $presenter
    )
    {
    }
    /**
     * Первый этап регистрации работодателя
     *
     * Отправляет ссылку на следующий этап по почте.
     */
    #[OpenApi\Operation(tags: ['Employer'], method: 'POST')]
    #[OpenApi\Parameters(RegisterParameters::class)]
    #[OpenApi\Response(RegisterResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(RegisterRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
