<?php declare(strict_types=1);
namespace App\Presenters\Auth\Employer;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterPresenter
{
    public function present(string $email): JsonResponse
    {
        return response()
            ->json(["email" => $email])
            ->setStatusCode(Response::HTTP_OK);
    }
}
