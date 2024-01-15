<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Presenters\User\UserPresenter;
use App\UseCases\Auth\RegisterUseCase;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(
        private RegisterUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }

    public function __invoke(RegisterRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
