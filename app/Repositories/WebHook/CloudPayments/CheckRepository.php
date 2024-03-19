<?php

namespace App\Repositories\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\CheckRequestDTO;
use App\Models\VacancyPayment;
use Carbon\Carbon;

class CheckRepository
{
    public function make(CheckRequestDTO $requestDTO): int
    {
        $payment = VacancyPayment::where('id','=',$requestDTO->invoice_id)->first();
        if(!$payment) {
            return 10;
        }
        if($payment->user_employer_id != $requestDTO->account_id) {
            return 11;
        }
        if($payment->summary != $requestDTO->amount) {
            return 12;
        }
        if(Carbon::parse($payment->created_at)->addDay() < Carbon::parse($requestDTO->date_time)) {
            return 20;
        }
        $payment->transaction_id = $requestDTO->transaction_id;
        $payment->save();
        return 0;
    }
}
