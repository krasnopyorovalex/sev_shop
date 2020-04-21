<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class GetCatalogProductByAliasQuery
 * @package Domain\CatalogProduct\Queries
 */
class GetCatalogProductByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetCatalogProductByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return CatalogProduct::where('alias', $this->alias)->firstOrFail();
    }
}
