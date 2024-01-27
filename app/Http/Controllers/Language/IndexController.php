<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\Language\IndexParameters;
use App\OpenApi\Responses\Language\IndexResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\Language\LanguagesPresenter;
use App\UseCases\Language\IndexUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private LanguagesPresenter $presenter
    )
    {
    }
    /**
     * Получение языков
     *
     * Получение языков.
     */
    #[OpenApi\Operation(tags: ['Language'], method: 'GET')]
    #[OpenApi\Parameters(IndexParameters::class)]
    #[OpenApi\Response(IndexResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(IndexRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
