<?php

declare(strict_types=1);

namespace Domain\Catalog\Queries;

use App\Catalog;

/**
 * Class GetCatalogByIdQuery
 * @package Domain\Catalog\Queries
 */
class GetCatalogByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetCatalogByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Catalog::with(['image', 'products', 'catalogs' => static function ($query) {
            return $query->with(['products']);
        }])->findOrFail($this->id);
    }
}
