<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Auth\LoginPasswordUseCase;
use Illuminate\Http\Request;

class LoginPasswordController extends Controller
{
    public function __construct(
        private LoginPasswordUseCase $useCase,
        private TokenPresenter $presenter
    )
    {
    }

    public function __invoke(LoginPasswordRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
