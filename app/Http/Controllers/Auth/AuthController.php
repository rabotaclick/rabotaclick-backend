<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Presenters\Auth\AuthPresenter;
use App\UseCases\Auth\AuthUseCase;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthUseCase $useCase,
        private AuthPresenter $presenter,
    )
    {
    }

    public function __invoke(AuthRequestInterface $request): mixed
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
