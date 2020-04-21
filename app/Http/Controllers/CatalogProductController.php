<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\CatalogProduct\Queries\GetCatalogProductByAliasQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CatalogProductController
 * @package App\Http\Controllers
 */
class CatalogProductController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias)
    {
        $product = $this->dispatch(new GetCatalogProductByAliasQuery($alias));

        return view('product.index', [
            'product' => $product
        ]);
    }
}
