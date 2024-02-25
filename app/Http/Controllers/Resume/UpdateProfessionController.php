<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdateProfessionRequestInterface;
use App\OpenApi\Parameters\Resume\UpdateProfessionParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\UseCases\Resume\UpdateProfessionUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateProfessionController extends Controller
{
    use \App\Traits\ValidateTrait;
    public function __construct(
        private UpdateProfessionUseCase $useCase,
        private ResumePresenter $presenter,
    )
    {
    }
    /**
     * Обновление профессии резюме
     *
     * Обновление профессии резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateProfessionParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateProfessionRequestInterface $request, string $id): JsonResponse
    {
        $this->validateResumeId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
