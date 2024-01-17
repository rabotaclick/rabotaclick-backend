<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Presenters\User\DeletePresenter;
use App\UseCases\User\DeleteUseCase;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __construct(
        private DeleteUseCase $useCase,
        private DeletePresenter $presenter,
    )
    {
    }

    public function __invoke()
    {
        $responseDTO = $this->useCase->execute();

        return $this->presenter->present($responseDTO);
    }
}
