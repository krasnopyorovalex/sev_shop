<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Queries;

use App\CatalogProduct;

/**
 * Class ExistsCatalogProductByNameQuery
 * @package Domain\CatalogProduct\Queries
 */
class ExistsCatalogProductByNameQuery
{
    /**
     * @var string
     */
    private $name;

    /**
     * ExistsCatalogProductByNameQuery constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        return CatalogProduct::where('name', $this->name)->exists();
    }
}
