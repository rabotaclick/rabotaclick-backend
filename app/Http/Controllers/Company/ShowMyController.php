<?php declare(strict_types=1);
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\OpenApi\Responses\Company\CompanyNotCreatedResponse;
use App\OpenApi\Responses\Company\CompanyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Company\CompanyPresenter;
use App\UseCases\Company\ShowMyUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class ShowMyController extends Controller
{
    public function __construct(
        private ShowMyUseCase $useCase,
        private CompanyPresenter $presenter
    )
    {
    }
    /**
     * Получение моей компании
     *
     * Получение моей компании.
     */
    #[OpenApi\Operation(tags: ['Company'], security: BearerToken::class, method: 'GET')]
    #[OpenApi\Response(CompanyResponse::class, 200)]
    #[OpenApi\Response(CompanyNotCreatedResponse::class, 400)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(): JsonResponse
    {
        $responseDTO = $this->useCase->execute();
        return $this->presenter->present($responseDTO);
    }
}
