<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\Presenters\Storage\UrlsPresenter;
use App\UseCases\Storage\PutUseCase;
use Illuminate\Http\Request;

class PutController extends Controller
{
    public function __construct(
        public PutUseCase $useCase,
        public UrlsPresenter $presenter,
    )
    {
    }

    public function __invoke(PutRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
