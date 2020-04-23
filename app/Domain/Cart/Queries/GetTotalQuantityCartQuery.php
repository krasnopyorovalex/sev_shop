<?php

declare(strict_types=1);

namespace Domain\Cart\Queries;

/**
 * Class GetTotalQuantityCartQuery
 * @package Domain\Cart\Queries
 */
class GetTotalQuantityCartQuery
{
    /**
     * @return float
     */
    public function handle(): float
    {
        return app('cart')->getTotalQuantity();
    }
}
