<?php declare(strict_types=1);
namespace App\Presenters\User;

use App\DTO\User\UserDTO;
use App\Http\Resources\User\Resource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserPresenter
{
    public function present(UserDTO $responseDTO): JsonResponse
    {
        return (new Resource($responseDTO->user))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
