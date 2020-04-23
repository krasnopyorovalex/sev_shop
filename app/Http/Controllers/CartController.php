<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\CatalogProduct;
use Domain\Cart\Commands\AddToCartCommand;
use Domain\Cart\Commands\RemoveCartItemCommand;
use Domain\Cart\Commands\UpdateCartCountCommand;
use Domain\Cart\Queries\GetAllItemsCartQuery;
use Domain\Cart\Queries\GetTotalPriceCartQuery;
use Domain\Cart\Queries\GetTotalQuantityCartQuery;
use Domain\Cart\Requests\AddToCartRequest;
use Domain\CatalogProduct\Queries\GetCatalogProductByIdQuery;
use Domain\Page\Queries\GetPageByAliasQuery;
use Darryldecode\Cart\CartCollection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CartController
 * @package App\Http\Controllers\Api
 */
class CartController extends Controller
{
    /**
     * @param string $alias
     * @return Application|Factory|View
     */
    public function index(string $alias = 'cart')
    {
        $page = $this->dispatch(new GetPageByAliasQuery($alias));
        $items = $this->dispatch(new GetAllItemsCartQuery());
        $total = $this->dispatch(new GetTotalPriceCartQuery());

        return view('cart.index', [
            'page' => $page,
            'items' => $items,
            'total' => number_format($total, 0, '.', ' ')
        ]);
    }

    /**
     * @param int $id
     * @param AddToCartRequest $request
     * @return array
     */
    public function add(int $id, AddToCartRequest $request): array
    {
        /** @var $product CatalogProduct */
        $product = $this->dispatch(new GetCatalogProductByIdQuery($id));

        /** @var $response CartCollection */
        $response = $this->dispatch(new AddToCartCommand($product, $request->get('count')));
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'content' => $response->toJson(),
            'message' => 'Товар добавлен в корзину',
            'quantity' => $quantity
        ];
    }

    /**
     * @param int $product
     * @return array
     */
    public function remove(int $product): array
    {
        $status = $this->dispatch(new RemoveCartItemCommand($product));
        $total = $this->dispatch(new GetTotalPriceCartQuery());
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'status' => $status,
            'message' => 'Товар удален',
            'total' => number_format($total, 0, '.', ' '),
            'quantity' => $quantity
        ];
    }

    /**
     * @param int $product
     * @param int $quantity
     * @return array
     */
    public function update(int $product, int $quantity): array
    {
        $product = $this->dispatch(new UpdateCartCountCommand($product, $quantity));
        $total = $this->dispatch(new GetTotalPriceCartQuery());
        $quantity = $this->dispatch(new GetTotalQuantityCartQuery());

        return [
            'product' => $product,
            'productPrice' => number_format($product->price * $product->quantity, 0, '.', ' '),
            'message' => 'Количество обновлено',
            'total' => number_format($total, 0, '.', ' '),
            'quantity' => $quantity
        ];
    }
}
