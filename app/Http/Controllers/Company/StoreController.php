<?php declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Contracts\StoreRequestInterface;
use App\OpenApi\Parameters\Company\StoreParameters;
use App\OpenApi\Responses\Company\CompanyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Company\CompanyPresenter;
use App\UseCases\Company\StoreUseCase;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class StoreController extends Controller
{
    public function __construct(
        private StoreUseCase $useCase,
        private CompanyPresenter $presenter,
    )
    {
    }
    /**
     * Создание компании
     *
     * Создание компании.
     */
    #[OpenApi\Operation(tags: ['Company'], security: BearerToken::class, method: 'POST')]
    #[OpenApi\Parameters(StoreParameters::class)]
    #[OpenApi\Response(CompanyResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(StoreRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
