<?php

declare(strict_types=1);

namespace Domain\Cart\Requests;

use App\Http\Requests\Request;

/**
 * Class UpdateCatalogRequest
 * @package Domain\Catalog\Requests
 */
class CheckoutCartRequest extends Request
{
    public function rules(): array
    {
        return [
            'fio' => 'bail|string|required|max:128',
            'phone' => 'required|string|max:16',
            'email' => 'email|nullable',
            'address' => 'string|nullable|max:255',
        ];
    }
}
