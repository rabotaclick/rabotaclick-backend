<?php

namespace App\Http\Controllers\WebHook\CloudPayments;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebHook\CloudPayments\Contracts\CheckRequestInterface;
use App\Presenters\WebHook\CloudPayments\CodePresenter;
use App\UseCases\WebHook\CloudPayments\CheckUseCase;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function __construct(
        private CheckUseCase $useCase,
        private CodePresenter $presenter
    )
    {
    }

    public function __invoke(CheckRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
