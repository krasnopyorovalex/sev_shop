<?php

declare(strict_types=1);

namespace Domain\Cart\Queries;

/**
 * Class GetTotalPriceCartQuery
 * @package Domain\Cart\Queries
 */
class GetTotalPriceCartQuery
{
    /**
     * @return float
     */
    public function handle(): float
    {
        return app('cart')->getTotal();
    }
}
