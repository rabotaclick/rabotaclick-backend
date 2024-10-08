<?php declare(strict_types=1);
namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\OpenApi\Parameters\Resume\DeleteParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Public\UnauthoraizedResponse;
use App\OpenApi\Responses\User\DeleteResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\DeletePresenter;
use App\UseCases\Resume\DeleteUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class DeleteController extends Controller
{
    use \App\Traits\ValidateTrait;
    public function __construct(
        private DeleteUseCase $useCase,
        private DeletePresenter $presenter,
    )
    {
    }
    /**
     * Удаление резюме
     *
     * Удаление резюме у пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'DELETE')]
    #[OpenApi\Parameters(DeleteParameters::class)]
    #[OpenApi\Response(DeleteResponse::class, 200)]
    #[OpenApi\Response(UnauthoraizedResponse::class, 403)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(string $id): JsonResponse
    {
        $this->validateResumeId($id);

        $response = $this->useCase->execute($id);

        return $this->presenter->present($response);
    }
}
