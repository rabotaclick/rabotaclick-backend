<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdateEducationRequestInterface;
use App\OpenApi\Parameters\Resume\UpdateEducationParameters;
use App\OpenApi\Parameters\Resume\UpdateWorkingHistoryParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\Resume\ValidateTrait;
use App\UseCases\Resume\UpdateEducationUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdateEducationController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdateEducationUseCase $useCase,
        private ResumePresenter $presenter
    )
    {
    }
    /**
     * Обновление опыта работы резюме
     *
     * Обновление опыта работы резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateEducationParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateEducationRequestInterface $request, string $id)
    {
        $this->validateId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
