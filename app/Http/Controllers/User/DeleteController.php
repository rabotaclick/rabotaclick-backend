<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\User\DeleteResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\User\DeletePresenter;
use App\UseCases\User\DeleteUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class DeleteController extends Controller
{
    public function __construct(
        private DeleteUseCase $useCase,
        private DeletePresenter $presenter,
    )
    {
    }
    /**
     * Удаление пользователя
     *
     * Удаление пользователя с помощью токена.
     */
    #[OpenApi\Operation(tags: ['User'], security: BearerToken::class ,method: 'DELETE')]
    #[OpenApi\Response(DeleteResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke()
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
