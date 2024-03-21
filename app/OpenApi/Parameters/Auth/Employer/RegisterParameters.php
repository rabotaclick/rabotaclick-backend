<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Auth\Employer;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class RegisterParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('email')
                ->description('Почта')
                ->required(true)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('password')
                ->description('Пароль')
                ->required(true)
                ->schema(Schema::string()),

        ];
    }
}
