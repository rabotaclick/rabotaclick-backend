<?php declare(strict_types=1);
namespace App\Presenters\User;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePresenter
{
    public function present(string $deleted_at): JsonResponse
    {
        return response()
            ->json([
                "deleted_at" => $deleted_at
            ])
            ->setStatusCode(Response::HTTP_OK);
    }
}
