<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CommerceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'mode' => ['required', Rule::in(['checkauth', 'init', 'file', 'import'])],
            'type' => ['required', Rule::in(['catalog', 'sale'])],
            'filename' => 'string|nullable',
            'sessid' => 'string|nullable'
        ];
    }
}
