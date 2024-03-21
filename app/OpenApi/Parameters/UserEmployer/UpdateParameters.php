<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\UserEmployer;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class UpdateParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('name')
                ->description('Имя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('surname')
                ->description('Фамилия')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('lastname')
                ->description('Отчество')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('password')
                ->description('Текущий пароль')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('new_password')
                ->description('Новый пароль')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
