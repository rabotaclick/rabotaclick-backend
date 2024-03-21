<?php declare(strict_types=1);
namespace App\Presenters\Resume;

use App\DTO\Resume\ResumeDTO;
use App\Http\Resources\Resume\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePresenter
{
    public function present(bool $response): JsonResponse
    {
        return response()
            ->json(["status" => $response])
            ->setStatusCode(Response::HTTP_OK);
    }
}
