<?php declare(strict_types=1);
namespace App\Helpers\Contracts;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

interface RequestFilterHelperInterface
{
    public function checkRequestParam(RequestParamEnumInterface $requestParam): mixed;

    public function filterBooleanRequestParam(RequestParamEnumInterface $requestParam): bool|null;
}
