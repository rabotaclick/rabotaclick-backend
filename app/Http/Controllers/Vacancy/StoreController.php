<?php

namespace App\Http\Controllers\Vacancy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\Contracts\StoreRequestInterface;
use App\Presenters\Vacancy\InvoicePresenter;
use App\Presenters\Vacancy\VacancyPresenter;
use App\UseCases\Vacancy\StoreUseCase;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(
        private StoreUseCase     $useCase,
        private InvoicePresenter $presenter,
    )
    {
    }

    public function __invoke(StoreRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
