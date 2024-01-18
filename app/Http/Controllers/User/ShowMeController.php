<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\User\ShowMeParameters;
use App\OpenApi\Responses\Public\RegisterResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\ShowMeUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class ShowMeController extends Controller
{
    public function __construct(
        private ShowMeUseCase $useCase,
        private UserPresenter $presenter
    )
    {
    }
    /**
     * Получение пользователя по токену
     *
     * Получение данных пользователя через авторизацию.
     */
    #[OpenApi\Operation(tags: ['User'], security: BearerToken::class ,method: 'GET')]
    #[OpenApi\Response(RegisterResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(Request $request)
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
