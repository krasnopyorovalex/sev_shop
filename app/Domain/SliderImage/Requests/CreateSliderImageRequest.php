<?php

declare(strict_types=1);

namespace Domain\SliderImage\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateSliderImageRequest
 * @package Domain\SliderImage\Requests
 */
class CreateSliderImageRequest extends Request
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'upload' => 'image',
            'sliderId' => 'integer'
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
            'upload.image' => 'Разрешено загружать только изображения',
            'sliderId.integer' => 'Поле «id слайдера» должно быть целым числом'
        ];
    }
}
