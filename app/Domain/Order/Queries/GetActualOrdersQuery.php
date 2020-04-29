<?php

declare(strict_types=1);

namespace Domain\Order\Queries;

use App\Order;

class GetActualOrdersQuery
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return Order::where('status', 'new')->get();
    }
}
