<?php declare(strict_types=1);
namespace App\OpenApi\Parameters\User;

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
                ->description('Новое имя пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('surname')
                ->description('Новая фамилия пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('lastname')
                ->description('Новое отчество пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('status')
                ->description('Статус пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('password')
                ->description('Текущий пароль пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('new_password')
                ->description('Новый пароль пользователя')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('change_email')
                ->description('Новая почта пользователя, после на почту придет код')
                ->required(false)
                ->schema(Schema::string()),
            Parameter::query()
                ->name('change_phone')
                ->description('Новый телефон пользователя, после на телефон придет смс и нужно будет подвердить')
                ->required(false)
                ->schema(Schema::string()),

        ];
    }
}
