<?php

namespace App\Http\Controllers\Email\Employer;

use App\Http\Controllers\Controller;
use App\Presenters\Auth\TokenPresenter;
use App\UseCases\Email\Employer\VerifyUseCase;
use Illuminate\Http\JsonResponse;

class VerifyController extends Controller
{
    public function __construct(
        private VerifyUseCase $useCase,
        private TokenPresenter $presenter,
    )
    {
    }
    public function __invoke(string $token): JsonResponse
    {
        $responseDTO = $this->useCase->execute($token);

        return $this->presenter->present($responseDTO);
    }
}
