<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\Auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class LoginPasswordParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('login')
                ->description('Либо телефон либо почта')
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
