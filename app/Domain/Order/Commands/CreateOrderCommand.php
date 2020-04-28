<?php

declare(strict_types=1);

namespace Domain\Order\Commands;

use App\Http\Requests\Request;
use App\Order;

/**
 * Class CreateOrderCommand
 * @package Domain\Order\Commands
 */
class CreateOrderCommand
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var int
     */
    private $total;

    /**
     * CreateOrderCommand constructor.
     * @param Request $request
     * @param int $total
     */
    public function __construct(Request $request, int $total)
    {
        $this->request = $request;
        $this->total = $total;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $order = new Order();
        $order->total = $this->total;
        $order->comment = (string)view('cart.message.cart-message-order', ['data' => $this->request->all()]);

        $order->save();

        $catalogProduct = array_keys(app('cart')->getContent()->toArray());

        $order->catalogProducts()->attach($catalogProduct);

        return true;
    }
}
