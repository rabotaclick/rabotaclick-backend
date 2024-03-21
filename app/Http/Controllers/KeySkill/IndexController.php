<?php declare(strict_types=1);
namespace App\Http\Controllers\KeySkill;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeySkill\Contracts\IndexRequestInterface;
use App\OpenApi\Parameters\KeySkill\IndexParameters;
use App\OpenApi\Responses\KeySkill\IndexResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\Presenters\KeySkill\KeySkillsPresenter;
use App\UseCases\KeySkill\IndexUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private KeySkillsPresenter $presenter,
    )
    {
    }
    /**
     * Получение ключевых навыков
     *
     * Получение ключевых навыков.
     */
    #[OpenApi\Operation(tags: ['KeySkill'], method: 'GET')]
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
