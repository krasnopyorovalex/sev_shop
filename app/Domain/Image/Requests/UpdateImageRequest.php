<?php

declare(strict_types=1);

namespace Domain\Image\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateImageRequest
 * @package Domain\Image\Requests
 */
class UpdateImageRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable'
        ];
    }
}
