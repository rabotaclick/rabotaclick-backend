<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Presenters\Email\EmailPresenter;
use App\UseCases\Email\VerifyUseCase;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function __construct(
        private VerifyUseCase $useCase,
        private EmailPresenter $presenter,
    )
    {
    }

    public function __invoke(string $token)
    {
        $responseDTO = $this->useCase->execute($token);

        return $this->presenter->present($responseDTO);
    }
}
