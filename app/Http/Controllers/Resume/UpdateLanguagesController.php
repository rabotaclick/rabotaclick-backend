<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdateLanguagesRequestInterface;
use App\OpenApi\Parameters\Resume\UpdateLanguagesParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Resume\UpdateLanguagesUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateLanguagesController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdateLanguagesUseCase $useCase,
        private ResumePresenter $presenter
    )
    {
    }
    /**
     * Обновление языков резюме
     *
     * Обновление языков резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateLanguagesParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateLanguagesRequestInterface $request, string $id): JsonResponse
    {
        $this->validateResumeId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
