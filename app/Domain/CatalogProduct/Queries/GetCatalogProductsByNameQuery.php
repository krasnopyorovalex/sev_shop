<?php

declare(strict_types=1);

namespace Domain\CatalogProduct\Queries;

use App\CatalogProduct;

class GetCatalogProductsByNameQuery
{
    /**
     * @var string
     */
    private $keyword;

    /**
     * GetEventsByNameQuery constructor.
     * @param string $keyword
     */
    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return CatalogProduct::where('name', 'like', '%' . $this->keyword . '%')->get();
    }
}
