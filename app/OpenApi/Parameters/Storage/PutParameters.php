<?php

namespace App\OpenApi\Parameters\Storage;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class PutParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('files')
                ->description('Файлы типа png, jpg, jpeg, webp')
                ->required(true)
                ->schema(Schema::array("files")),

        ];
    }
}
