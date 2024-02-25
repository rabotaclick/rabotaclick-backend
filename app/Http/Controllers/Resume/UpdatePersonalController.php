<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdatePersonalRequestInterface;
use App\OpenApi\Parameters\Resume\UpdatePersonalParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\Resume\ValidateTrait;
use App\UseCases\Resume\UpdatePersonalUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdatePersonalController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdatePersonalUseCase $useCase,
        private ResumePresenter $presenter,
    )
    {
    }
    /**
     * Обновление персональной информации резюме
     *
     * Обновление персональной информации резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdatePersonalParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdatePersonalRequestInterface $request, string $id): JsonResponse
    {
        $this->validateId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
