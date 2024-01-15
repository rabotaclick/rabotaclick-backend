<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequestInterface $request): mixed
    {
        $requestDTO = $request->getValidated();


    }
}
