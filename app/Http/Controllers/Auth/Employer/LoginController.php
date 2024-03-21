<?php declare(strict_types=1);
namespace App\Http\Controllers\Auth\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Employer\Contracts\LoginRequestInterface;
use App\OpenApi\Parameters\Auth\Employer\LoginParameters;
use App\OpenApi\Responses\Auth\LoginResponse;
use App\OpenApi\Responses\Public\InvalidCredentialsResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Auth\Employer\LoginUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class LoginController extends Controller
{
    public function __construct(
        private LoginUseCase $useCase,
        private TokenPresenter $presenter
    )
    {
    }
    /**
     * Вход пользователя
     *
     * Вход пользователя работодателя.
     */
    #[OpenApi\Operation(tags: ['Employer'], method: 'POST')]
    #[OpenApi\Parameters(LoginParameters::class)]
    #[OpenApi\Response(LoginResponse::class, 200)]
    #[OpenApi\Response(InvalidCredentialsResponse::class, 401)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 512)]
    public function __invoke(LoginRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
