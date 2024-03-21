<?php declare(strict_types=1);
namespace App\Http\Requests\SubSpecialization;

use App\DTO\SubSpecialization\IndexRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\SubSpecialization\Contracts\IndexRequestInterface;
use App\Http\Requests\SubSpecialization\Enums\IndexRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements IndexRequestInterface
{
    public function rules(): array
    {
        return [
            IndexRequestEnum::Search->value => 'string|max:32'
        ];
    }

    public function getValidated(): IndexRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new IndexRequestDTO(
            $filter->checkRequestParam(IndexRequestEnum::Search)
        );
    }
}
