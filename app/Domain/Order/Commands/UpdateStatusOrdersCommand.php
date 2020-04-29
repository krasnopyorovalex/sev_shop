<?php

declare(strict_types=1);

namespace Domain\Order\Commands;

use App\Order;

class UpdateStatusOrdersCommand
{
    public function handle(): void
    {
        Order::where('status', 'new')->update([
            'status' => 'processed'
        ]);
    }
}
