<?php

namespace App\Http\Controllers\WebHook\CloudPayments;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebHook\CloudPayments\Contracts\PayRequestInterface;
use App\Presenters\WebHook\CloudPayments\CodePresenter;
use App\UseCases\WebHook\CloudPayments\PayUseCase;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function __construct(
        private PayUseCase $useCase,
        private CodePresenter $presenter
    )
    {
    }

    public function __invoke(PayRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
