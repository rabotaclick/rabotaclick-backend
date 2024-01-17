<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Contracts\UpdateRequestInterface;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\UpdateUseCase;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __construct(
        private UpdateUseCase $useCase,
        private UserPresenter $presenter,
    )
    {
    }

    public function __invoke(UpdateRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
