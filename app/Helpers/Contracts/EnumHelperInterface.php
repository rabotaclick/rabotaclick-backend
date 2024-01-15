<?php

namespace App\Helpers\Contracts;

interface EnumHelperInterface
{
    public function getValues(string $enum): array;

    public function serialize(string $enum): string;
}
