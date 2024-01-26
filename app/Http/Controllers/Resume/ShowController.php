<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\Resume\StoreParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\Responses\Resume\TooManyResumesResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\Resume\ValidateTrait;
use App\UseCases\Resume\ShowUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class ShowController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private ShowUseCase $useCase,
        private ResumePresenter $presenter,
    )
    {
    }
    /**
     * Получение резюме
     *
     * Получение резюме для пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'GET')]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(string $id)
    {
        $this->validateId($id);

        $responseDTO = $this->useCase->execute($id);

        return $this->presenter->present($responseDTO);
    }
}
