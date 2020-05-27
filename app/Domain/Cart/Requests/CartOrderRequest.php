<?php

declare(strict_types=1);

namespace Domain\Cart\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateCatalogRequest
 * @package Domain\Catalog\Requests
 */
class CartOrderRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'bail|string|required|min:3|max:128|regex:/[А-Яа-яЁё]/u',
            'phone' => 'required|string|max:18',
            'address' => 'required|string|max:255',
            'date' => 'required|date_format:"d.m.Y"|after:today',
            'time' => 'required|string',
            'comment' => 'string|nullable'
        ];
    }
}
