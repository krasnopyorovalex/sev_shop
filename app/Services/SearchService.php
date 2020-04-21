<?php

declare(strict_types=1);

namespace App\Services;

use Domain\CatalogProduct\Queries\GetCatalogProductsByNameQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SearchService
 * @package App\Services
 */
class SearchService
{
    use DispatchesJobs;

    /**
     * @var array
     */
    protected $matches = [];

    /**
     * @param string $keyword
     * @return mixed
     */
    public function search(string $keyword)
    {
        return $this->dispatch(new GetCatalogProductsByNameQuery($keyword));
    }
}
