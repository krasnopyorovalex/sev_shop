<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Cart\Commands\ClearCartCommand;
use App\Mail\CartOrderSent;
use Domain\Cart\Queries\GetTotalPriceCartQuery;
use Domain\Cart\Requests\CartOrderRequest;
use Domain\Order\Commands\CreateOrderCommand;
use Exception;
use Illuminate\Http\RedirectResponse;
use Log;
use Mail;

/**
 * Class CartOrderController
 * @package App\Http\Controllers
 */
class CartOrderController extends Controller
{
    /**
     * @param CartOrderRequest $request
     * @return RedirectResponse
     */
    public function __invoke(CartOrderRequest $request)
    {
        try {
            Mail::to(['djShtaket88@mail.ru'])->send(new CartOrderSent($request->all()));

            $total = (int)$this->dispatch(new GetTotalPriceCartQuery());

            $this->dispatch(new CreateOrderCommand($request, $total));

            $this->dispatch(new ClearCartCommand);

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('message', 'При оформлении заказа возникла ошибка:( Повторите, пожалуйста, позже.');
        }

        return back()->with('message', 'Ваш заказ принят и находится в обработке. Спасибо за покупку!');
    }
}
