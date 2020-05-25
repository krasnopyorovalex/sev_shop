<?php

namespace App\Http\Requests\Forms;

use App\Http\Requests\Request;

/**
 * Class ConsultationRequest
 * @package App\Http\Requests\Forms
 */
class ConsultationRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|regex:/[А-Яа-яЁё]/u',
            'phone' => 'required|string|min:5'
        ];
    }
}
