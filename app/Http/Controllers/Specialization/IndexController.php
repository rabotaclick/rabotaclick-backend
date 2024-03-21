<?php declare(strict_types=1);
namespace App\Http\Controllers\Specialization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\Specialization\IndexParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Specialization\IndexResponse;
use App\Presenters\Specialization\IndexPresenter;
use App\UseCases\Specialization\IndexUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]

class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private IndexPresenter $presenter
    )
    {
    }
    /**
     * Получение категорий вакансий
     *
     * Получение категорий вакансий с пагинацией и сортировкой.
     */
    #[OpenApi\Operation(tags: ['Specialization'] ,method: 'GET')]
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
