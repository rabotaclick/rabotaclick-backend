<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneOrEmailRule implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value): bool
    {
        return preg_match('/^(\+?)(\d{10}|\d{11})$/', $value) || filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function message(): string
    {
        return 'Неверный номер телефона или почта';
    }
}
