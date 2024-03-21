<?php declare(strict_types=1);
namespace App\Http\Controllers\UserEmployer;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\UserEmployer\UserEmployerResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\UserEmployer\UserEmployerPresenter;
use App\UseCases\UserEmployer\ShowMeUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class ShowMeController extends Controller
{
    public function __construct(
        private ShowMeUseCase $useCase,
        private UserEmployerPresenter $presenter,
    )
    {
    }
    /**
     * Получение пользователя по токену
     *
     * Получение данных пользователя через авторизацию.
     */
    #[OpenApi\Operation(tags: ['UserEmployer'], security: BearerToken::class ,method: 'GET')]
    #[OpenApi\Response(UserEmployerResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(): JsonResponse
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
