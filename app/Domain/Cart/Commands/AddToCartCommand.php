<?php

declare(strict_types=1);

namespace Domain\Cart\Commands;

use App\CatalogProduct;
use Domain\Cart\Queries\GetAllItemsCartQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Darryldecode\Cart\CartCollection;
use Exception;

/**
 * Class AddToCartCommand
 * @package Domain\Cart\Commands
 */
class AddToCartCommand
{
    use DispatchesJobs;

    private $product;
    /**
     * @var int
     */
    private $count;

    /**
     * AddToCartCommand constructor.
     * @param CatalogProduct $product
     * @param int $count
     */
    public function __construct(CatalogProduct $product, int $count = 1)
    {
        $this->product = $product;
        $this->count = $count;
    }

    /**
     * @return CartCollection
     * @throws Exception
     */
    public function handle(): CartCollection
    {
        app('cart')->add($this->product->id, $this->product->name, $this->product->price, $this->count, [
            'image' => $this->product->image ? $this->product->image->path : asset('img/default-product.png'),
            'url' => $this->product->url
        ]);

        return $this->dispatch(new GetAllItemsCartQuery());
    }
}
