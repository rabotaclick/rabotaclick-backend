<?php declare(strict_types=1);
namespace App\Presenters\Resume;

use App\DTO\Resume\ResumeDTO;
use App\Http\Resources\Resume\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResumePresenter
{
    public function present(ResumeDTO $responseDTO): JsonResponse
    {
        return (new Resource($responseDTO->resume))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
