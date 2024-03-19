<?php

namespace App\Presenters\WebHook\CloudPayments;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CodePresenter
{
    public function present(int $code): JsonResponse
    {
        return response()->json([
            'code' => $code
        ])->setStatusCode(Response::HTTP_OK);
    }
}
