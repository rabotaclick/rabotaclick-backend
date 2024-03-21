<?php declare(strict_types=1);
namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\Contracts\StoreRequestInterface;
use App\OpenApi\Parameters\Vacancy\StoreParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Vacancy\StoreResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Vacancy\InvoicePresenter;
use App\Presenters\Vacancy\VacancyPresenter;
use App\UseCases\Vacancy\StoreUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class StoreController extends Controller
{
    public function __construct(
        private StoreUseCase     $useCase,
        private InvoicePresenter $presenter,
    )
    {
    }
    /**
     * Создание вакансии
     *
     * Создание вакансии и дальнейшая оплата.
     */
    #[OpenApi\Operation(tags: ['Vacancy'], security: BearerToken::class, method: 'POST')]
    #[OpenApi\Parameters(StoreParameters::class)]
    #[OpenApi\Response(StoreResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(StoreRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
