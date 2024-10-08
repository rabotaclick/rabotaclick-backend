<?php declare(strict_types=1);
namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdateContactsRequestInterface;
use App\OpenApi\Parameters\Resume\UpdateContactsParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Public\UnauthoraizedResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Resume\UpdateContactsUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class UpdateContactsController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdateContactsUseCase $useCase,
        private ResumePresenter $presenter
    )
    {
    }
    /**
     * Обновление контактов резюме
     *
     * Обновление контактов резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateContactsParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(UnauthoraizedResponse::class, 403)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateContactsRequestInterface $request, string $id): JsonResponse
    {
        $this->validateResumeId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
