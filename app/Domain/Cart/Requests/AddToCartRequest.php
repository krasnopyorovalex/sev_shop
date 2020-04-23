<?php

declare(strict_types=1);

namespace Domain\Cart\Requests;

use App\Http\Requests\Request;

/**
 * Class AddToCartRequest
 * @package Domain\Cart\Requests
 */
class AddToCartRequest extends Request
{
    public function rules(): array
    {
        return [
            'count' => 'required|integer|min:1'
        ];
    }
}
