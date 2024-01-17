<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\UpdatePhoneUseCase;
use Illuminate\Http\Request;

class UpdatePhoneController extends Controller
{
    public function __construct(
        private UpdatePhoneUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }

    public function __invoke(UpdatePhoneRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
