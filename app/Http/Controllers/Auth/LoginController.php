<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Auth\LoginUseCase;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        private LoginUseCase $useCase,
        private TokenPresenter $presenter,
    )
    {
    }

    public function __invoke(LoginRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
