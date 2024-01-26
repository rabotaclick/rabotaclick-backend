<?php

namespace App\Traits\Resume;

trait FormatMonthsTrait
{
    private function formatMonths($months)
    {
        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        $result = [];

        if ($years > 0) {
            $result[] = ($years > 1) ? "$years года" : "1 год";
        }

        if ($remainingMonths > 0) {
            $result[] = ($remainingMonths === 1) ? "1 месяц" : (
            ($remainingMonths >= 2 && $remainingMonths <= 4) ? "$remainingMonths месяца" : "$remainingMonths месяцев"
            );
        }

        return implode(', ', $result);
    }
}
