<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Contracts\UpdateRequestInterface;
use App\OpenApi\Parameters\User\UpdateParameters;
use App\OpenApi\Responses\Public\RegisterResponse;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\User\InvalidEmailErrorResponse;
use App\OpenApi\Responses\User\InvalidPhoneErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\UpdateUseCase;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class UpdateController extends Controller
{
    public function __construct(
        private UpdateUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }
    /**
     * Обновление пользователя
     *
     * Обновление пользователя так же обновление почты и телефона.
     */
    #[OpenApi\Operation(tags: ['User'], security: BearerToken::class ,method: 'PUT')]
    #[OpenApi\Parameters(UpdateParameters::class)]
    #[OpenApi\Response(RegisterResponse::class, 200)]
    #[OpenApi\Response(InvalidEmailErrorResponse::class, 422)]
    #[OpenApi\Response(InvalidPhoneErrorResponse::class, 422)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(UpdateRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
