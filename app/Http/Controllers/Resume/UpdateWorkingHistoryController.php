<?php declare(strict_types=1);
namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdateWorkingHistoryRequestInterface;
use App\OpenApi\Parameters\Resume\UpdateWorkingHistoryParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Public\UnauthoraizedResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Resume\UpdateWorkingHistoryUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateWorkingHistoryController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdateWorkingHistoryUseCase $useCase,
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
    #[OpenApi\Parameters(UpdateWorkingHistoryParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(UnauthoraizedResponse::class, 403)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateWorkingHistoryRequestInterface $request, string $id): JsonResponse
    {
        $this->validateResumeId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
