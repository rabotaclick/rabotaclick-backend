<?php declare(strict_types=1);
namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\Resume\IndexParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\IndexResponse;
use App\Presenters\Resume\ResumesPresenter;
use App\UseCases\Resume\IndexUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private ResumesPresenter $presenter,
    )
    {
    }
    /**
     * Поиск резюме
     *
     * Поиск резюме с фильтрами.
     */
    #[OpenApi\Operation(tags: ['Resume'], method: 'POST')]
    #[OpenApi\Parameters(IndexParameters::class)]
    #[OpenApi\Response(IndexResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(IndexRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
