<?php declare(strict_types=1);
namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdateLanguagesRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Language\Enums\LanguageLevelEnum;
use App\Http\Requests\Resume\Contracts\UpdateLanguagesRequestInterface;
use App\Http\Requests\Resume\Enums\UpdateLanguagesRequestEnum;
use App\Models\Language;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguagesRequest extends FormRequest implements UpdateLanguagesRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            UpdateLanguagesRequestEnum::MainLanguageId->value => 'uuid|exists:languages,id',

            UpdateLanguagesRequestEnum::Languages->value => 'array',
            UpdateLanguagesRequestEnum::Languages->value . '.manipulate.*.language_id' => 'required|exists:languages,id',
            UpdateLanguagesRequestEnum::Languages->value . '.manipulate.*.level' => 'required|in:' . $enumHelper->serialize(LanguageLevelEnum::class),

            UpdateLanguagesRequestEnum::Languages->value . '.delete.*' => 'uuid|exists:languages,id',
        ];
    }

    public function getValidated(): UpdateLanguagesRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateLanguagesRequestDTO(
            Language::find($filter->checkRequestParam(UpdateLanguagesRequestEnum::MainLanguageId)),
            $filter->checkRequestParam(UpdateLanguagesRequestEnum::Languages)
        );
    }
}
