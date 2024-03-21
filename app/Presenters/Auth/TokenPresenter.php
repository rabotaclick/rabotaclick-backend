<?php declare(strict_types=1);
namespace App\Presenters\Auth;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TokenPresenter
{
    public function present(string $token): JsonResponse
    {
        return response()
            ->json(["token" => $token])
            ->setStatusCode(Response::HTTP_OK);
    }
}
