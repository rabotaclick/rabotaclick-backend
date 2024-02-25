<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Contracts\UpdatePhotoRequestInterface;
use App\OpenApi\Parameters\Resume\UpdatePhotoParameters;
use App\OpenApi\Responses\Company\CompanyNotCreatedResponse;
use App\OpenApi\Responses\Company\CompanyResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Company\CompanyPresenter;
use App\UseCases\Company\UpdatePhotoUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdatePhotoController extends Controller
{
    public function __construct(
        private UpdatePhotoUseCase $useCase,
        private CompanyPresenter $presenter,
    )
    {
    }
    /**
     * Обновление фото компании
     *
     * Обновление фото компании.
     */
    #[OpenApi\Operation(tags: ['Company'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdatePhotoParameters::class)]
    #[OpenApi\Response(CompanyResponse::class, 200)]
    #[OpenApi\Response(CompanyNotCreatedResponse::class, 400)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdatePhotoRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
