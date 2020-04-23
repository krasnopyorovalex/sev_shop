<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Cart\Commands\ClearCartCommand;
use App\Mail\CheckoutCartSent;
use Domain\Cart\Requests\CheckoutCartRequest;
use Mail;

/**
 * Class CartOrderController
 * @package App\Http\Controllers
 */
class CartOrderController extends Controller
{
    /**
     * @param CheckoutCartRequest $request
     * @return array
     */
    public function order(CheckoutCartRequest $request): array
    {
        Mail::to(['fabrikabani@mail.ru'])->send(new CheckoutCartSent($request->all()));

        $this->dispatch(new ClearCartCommand);

        return [
            'message' => 'Ваша заявка отправлена успешно. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200,
            'clear' => true
        ];
    }
}
