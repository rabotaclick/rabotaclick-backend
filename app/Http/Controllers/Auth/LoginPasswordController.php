<?php declare(strict_types=1);
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\OpenApi\Parameters\Auth\LoginPasswordParameters;
use App\OpenApi\Responses\Auth\LoginResponse;
use App\OpenApi\Responses\Public\InvalidCredentialsResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Auth\LoginPasswordUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class LoginPasswordController extends Controller
{
    public function __construct(
        private LoginPasswordUseCase $useCase,
        private TokenPresenter $presenter
    )
    {
    }
    /**
     * Вход пользователя с помощью пароля
     *
     * Вход пользователя с помощью пароля и логина (почта или телефон).
     */
    #[OpenApi\Operation(tags: ['Applicant'], method: 'POST')]
    #[OpenApi\Parameters(LoginPasswordParameters::class)]
    #[OpenApi\Response(LoginResponse::class, 200)]
    #[OpenApi\Response(InvalidCredentialsResponse::class, 401)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 512)]
    public function __invoke(LoginPasswordRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
