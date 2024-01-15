<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Presenters\User\UserPresenter;
use App\UseCases\User\ShowMeUseCase;
use Illuminate\Http\Request;

class ShowMeController extends Controller
{
    public function __construct(
        private ShowMeUseCase $useCase,
        private UserPresenter $presenter
    )
    {
    }

    public function __invoke(Request $request)
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
