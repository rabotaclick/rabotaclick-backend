<?php

function normalizePhone($phone): string
{
    $phone = preg_replace('/[^+0-9]/', '', $phone);

    if (!str_starts_with($phone, '+')) {
        $phone = '+' . $phone;
    }
    if (substr($phone, 1, 1) == 8) {
        $phone = substr($phone, 2);
        $phone = '+7' . $phone;
    }
    return $phone;
}
