<?php

namespace Domain\Catalog\Requests;

use App\Http\Requests\Request;

/**
 * Class AddToCartRequest
 * @package Domain\Catalog\Requests
 */
class CreateCatalogRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:512',
            'text' => 'string|nullable',
            'alias' => 'required|string|max:255|unique:catalogs',
            'parent_id' => 'numeric|exists:catalogs,id|nullable',
            'image' => 'image',
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
