<?php

namespace App\Presenters\Auth;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthPresenter
{
    public function present(string $phone): JsonResponse
    {
        return response()
            ->json(["phone" => $phone])
            ->setStatusCode(Response::HTTP_OK);
    }
}
