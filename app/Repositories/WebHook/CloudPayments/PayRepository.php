<?php

namespace App\Repositories\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\PayRequestDTO;
use App\Models\VacancyPayment;

class PayRepository
{
    public function make(PayRequestDTO $requestDTO): int
    {
        $payment = VacancyPayment::where('transaction_id','=',$requestDTO->transaction_id)->first();
        $payment->status = 'completed';
        $payment->payed_at = now()->format('Y-m-d');
        $payment->save();

        $vacancy = $payment->vacancy;
        $vacancy->is_active = true;
        $vacancy->save();

        return 0;
    }
}
