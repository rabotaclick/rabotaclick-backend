<?php

namespace App\Http\Controllers\VacancyCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyCategory\Contracts\IndexRequestInterface;
use App\Presenters\VacancyCategory\IndexPresenter;
use App\UseCases\VacancyCategory\IndexUseCase;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(
        private IndexUseCase $useCase,
        private IndexPresenter $presenter
    )
    {
    }

    public function __invoke(IndexRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
