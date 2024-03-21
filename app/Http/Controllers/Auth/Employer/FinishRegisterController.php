<?php declare(strict_types=1);
namespace App\Http\Controllers\Auth\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Employer\Contracts\FinishRegisterRequestInterface;
use App\OpenApi\Parameters\Auth\RegisterParameters;
use App\OpenApi\Responses\Auth\RegisterAlreadyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\UserEmployer\UserEmployerResponse;
use App\Presenters\UserEmployer\UserEmployerPresenter;
use App\UseCases\Auth\Employer\FinishRegisterUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class FinishRegisterController extends Controller
{
    public function __construct(
        private FinishRegisterUseCase $useCase,
        private UserEmployerPresenter $presenter,
    )
    {
    }
    /**
     * Предпоследний этап регистрации
     *
     * Задает пользователю Имя и Фамилию.
     */
    #[OpenApi\Operation(tags: ['Employer'], security: 'BearerToken', method: 'POST')]
    #[OpenApi\Parameters(RegisterParameters::class)]
    #[OpenApi\Response(UserEmployerResponse::class, 200)]
    #[OpenApi\Response(RegisterAlreadyResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(FinishRegisterRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
