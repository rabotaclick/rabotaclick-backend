<?php declare(strict_types=1);
namespace App\Helpers;

use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Helpers\Exceptions\BooleanFilterHelperException;
use App\Http\Requests\Contracts\RequestParamEnumInterface;

class RequestFilterHelper implements RequestFilterHelperInterface
{
    public function __construct(
        private array $requestParams
    )
    {
    }

    public function checkRequestParam(RequestParamEnumInterface $requestParam): mixed
    {
        return $this->requestParams[$requestParam->value] ?? null;
    }

    /**
     * @throws BooleanFilterHelperException
     */
    public function filterBooleanRequestParam(RequestParamEnumInterface $requestParam): bool|null
    {
        return isset($this->requestParams[$requestParam->value])
            ? $this->filterBooleanValue($this->requestParams[$requestParam->value])
            : null;
    }

    /**
     * @throws BooleanFilterHelperException
     */
    private function filterBooleanValue(string $value): bool
    {
        return match ($value) {
            'true' => true,
            'false' => false,
            default => throw new BooleanFilterHelperException(
                'The param value must be able to be cast as a boolean.'
            ),
        };
    }
}
