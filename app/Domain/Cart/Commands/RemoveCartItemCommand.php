<?php

declare(strict_types=1);

namespace Domain\Cart\Commands;

use Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RemoveCartItemCommand
 * @package Domain\Cart\Commands
 */
class RemoveCartItemCommand
{
    use DispatchesJobs;
    /**
     * @var int
     */
    private $product;


    /**
     * RemoveCartItemCommand constructor.
     * @param int $product
     */
    public function __construct(int $product)
    {
        $this->product = $product;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $product = $this->dispatch(new GetCatalogProductByIdQuery($this->product));

        return app('cart')->remove($product->id);
    }
}
