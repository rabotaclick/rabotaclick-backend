<?php declare(strict_types=1);
namespace App\Http\Requests\Language;

use App\DTO\Language\IndexRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Language\Contracts\IndexRequestInterface;
use App\Http\Requests\Language\Enums\IndexRequestEnum;
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
