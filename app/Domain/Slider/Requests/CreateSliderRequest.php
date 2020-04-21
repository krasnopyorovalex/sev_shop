<?php

declare(strict_types=1);

namespace Domain\Slider\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateSliderRequest
 * @package Domain\Slider\Requests
 */
class CreateSliderRequest extends Request
{
    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|max:255'
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
            'name.required' => 'Поле «Название» обязательно для заполнения'
        ];
    }
}
