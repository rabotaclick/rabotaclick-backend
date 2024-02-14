<?php

namespace App\Http\Controllers\Email\Employer;

use App\Http\Controllers\Controller;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Email\Employer\VerifyUseCase;
class VerifyController extends Controller
{
    public function __construct(
        private VerifyUseCase $useCase,
        private TokenPresenter $presenter,
    )
    {
    }
    public function __invoke(string $token)
    {
        $responseDTO = $this->useCase->execute($token);

        return $this->presenter->present($responseDTO);
    }
}
