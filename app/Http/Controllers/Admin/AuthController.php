<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contracts\AuthRequestInterface;
use App\UseCases\Admin\AuthUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private AuthUseCase $useCase,
    )
    {
    }

    public function __invoke(AuthRequestInterface $request)
    {
        $requestDTO = $request->getValidated();

        $response = $this->useCase->execute($requestDTO);

        if($response) {
            $request->session()->regenerate();
            return redirect('/pulse');
        }
    }
}
