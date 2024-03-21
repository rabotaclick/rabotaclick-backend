<?php declare(strict_types=1);
namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\Contracts\UpdateRequestInterface;
use App\OpenApi\Parameters\Vacancy\UpdateParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Public\UnauthoraizedResponse;
use App\OpenApi\Responses\Vacancy\VacancyResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Vacancy\VacancyPresenter;
use App\Traits\ValidateTrait;
use App\UseCases\Vacancy\UpdateUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdateController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdateUseCase $useCase,
        private VacancyPresenter $presenter
    )
    {
    }
    /**
     * Редактирование вакансии
     *
     * Редактирование вакансии по токену.
     */
    #[OpenApi\Operation(tags: ['Vacancy'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdateParameters::class)]
    #[OpenApi\Response(VacancyResponse::class, 200)]
    #[OpenApi\Response(UnauthoraizedResponse::class, 403)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateRequestInterface $request, string $id)
    {
        $this->validateVacancyId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
