<?php declare(strict_types=1);
namespace App\Presenters\Vacancy;

use App\DTO\Vacancy\StoreResponseDTO;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvoicePresenter
{
    public function present(StoreResponseDTO $responseDTO): JsonResponse
    {
        return response()
            ->json([
                'invoiceID' => $responseDTO->invoiceID,
                'amount' => $responseDTO->amount,
                'user' => $responseDTO->userEmployer
            ])
            ->setStatusCode(Response::HTTP_OK);
    }
}
