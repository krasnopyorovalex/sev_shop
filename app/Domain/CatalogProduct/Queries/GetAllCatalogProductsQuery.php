<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Queries;

use App\Catalog;
use App\CatalogProduct;

/**
 * Class GetAllCatalogsQuery
 * @property Catalog catalog
 * @package Domain\CatalogProduct\Queries
 */
class GetAllCatalogProductsQuery
{
    private $catalog;

    private $excludedId;
    /**
     * @var bool
     */
    private $paginate;

    /**
     * GetAllCatalogProductsQuery constructor.
     * @param null $catalog
     * @param null $excludedId
     * @param bool $paginate
     */
    public function __construct($catalog = null, $excludedId = null, $paginate = false)
    {
        $this->catalog = $catalog;
        $this->excludedId = $excludedId;
        $this->paginate = $paginate;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = CatalogProduct::with(['catalog'])->orderBy('pos');

        if ($this->catalog) {
            $query->where('catalog_id', $this->catalog);
        }

        if ($this->excludedId) {
            $query->where('id', '<>', $this->excludedId);
        }

        if ($this->paginate) {
            return $query->paginate(50);
        }

        return $query->get();
    }
}
