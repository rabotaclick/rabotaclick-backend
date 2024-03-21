<?php declare(strict_types=1);
namespace App\Http\Requests\WebHook\CloudPayments\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum CheckRequestEnum: string implements RequestParamEnumInterface
{
    case InvoiceId = 'InvoiceId';
    case AccountId = 'AccountId';
    case DateTime = 'DateTime';
    case Amount = 'Amount';
    case TransactionId = 'TransactionId';
}
