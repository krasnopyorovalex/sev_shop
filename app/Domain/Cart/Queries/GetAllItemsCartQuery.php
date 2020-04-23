<?php

declare(strict_types=1);

namespace Domain\Cart\Queries;

use Darryldecode\Cart\CartCollection;

/**
 * Class GetAllItemsCartQuery
 * @package Domain\Cart\Queries
 */
class GetAllItemsCartQuery
{
    /**
     * @return CartCollection
     */
    public function handle(): CartCollection
    {
        return app('cart')->getContent();
    }
}
