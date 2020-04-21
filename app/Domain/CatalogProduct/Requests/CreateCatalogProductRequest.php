<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCatalogProductRequest
 * @package Domain\CatalogProduct\Requests
 */
class CreateCatalogProductRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:512',
            'catalog_id' => 'required|numeric|exists:catalogs,id',
            'label' => 'string|max:16|nullable',
            'price' => 'integer|max:16777215',
            'text' => 'string|nullable',
            'alias' => 'required|max:255|unique:catalog_products',
            'pos' => 'integer|min:0|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'text.required' => 'Поле «Текст» обязательно для заполнения',
            'alias.required' => 'Поле «Alias» обязательно для заполнения',
            'alias.unique' => 'Значение поля «Alias» уже присутствует в базе данных',
        ];
    }
}
