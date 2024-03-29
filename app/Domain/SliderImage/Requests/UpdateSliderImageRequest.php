<?php

declare(strict_types=1);

namespace Domain\SliderImage\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateSliderImageRequest
 * @package Domain\SliderImage\Requests
 */
class UpdateSliderImageRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'alt' => 'string|max:255|nullable',
            'sub' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'desc' => 'string|max:512|nullable',
            'is_published' => Rule::in([0, 1])
        ];
    }
}
