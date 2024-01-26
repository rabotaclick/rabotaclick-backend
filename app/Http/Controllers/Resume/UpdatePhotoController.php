<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\Contracts\UpdatePhotoRequestInterface;
use App\OpenApi\Parameters\Resume\UpdatePersonalParameters;
use App\OpenApi\Parameters\Resume\UpdatePhotoParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Resume\ResumeResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\Resume\ResumePresenter;
use App\Traits\Resume\ValidateTrait;
use App\UseCases\Resume\UpdatePhotoUseCase;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdatePhotoController extends Controller
{
    use ValidateTrait;
    public function __construct(
        private UpdatePhotoUseCase $useCase,
        private ResumePresenter $presenter,
    )
    {
    }
    /**
     * Обновление фото резюме
     *
     * Обновление фото резюме пользователя.
     */
    #[OpenApi\Operation(tags: ['Resume'], security: BearerToken::class, method: 'PUT')]
    #[OpenApi\Parameters(UpdatePhotoParameters::class)]
    #[OpenApi\Response(ResumeResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdatePhotoRequestInterface $request, string $id)
    {
        $this->validateId($id);

        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO, $id);

        return $this->presenter->present($responseDTO);
    }
}
