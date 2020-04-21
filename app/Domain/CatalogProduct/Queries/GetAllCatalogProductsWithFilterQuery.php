<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Queries;

use App\Catalog;
use App\CatalogProduct;

/**
 * Class GetAllCatalogProductsWithFilterQuery
 * @property Catalog catalog
 * @package Domain\CatalogProduct\Queries
 */
class GetAllCatalogProductsWithFilterQuery
{
    /**
     * @var Catalog
     */
    private $catalog;

    /**
     * GetAllCatalogProductsWithFilterQuery constructor.
     * @param Catalog $catalog
     */
    public function __construct(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return CatalogProduct::whereCatalogId($this->catalog->id)->paginate();
    }
}
