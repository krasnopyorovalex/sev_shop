<?php

declare(strict_types=1);

namespace App\Http\Requests;

class SearchRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'keyword' => 'required|string|min:3'
        ];
    }
}
