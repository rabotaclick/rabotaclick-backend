<?php declare(strict_types=1);
namespace App\Helpers\Contracts;

interface EnumHelperInterface
{
    public function getValues(string $enum): array;

    public function serialize(string $enum): string;
}
