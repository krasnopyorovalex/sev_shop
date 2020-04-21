<?php

declare(strict_types=1);

namespace Domain\Catalog\Queries;

use App\Catalog;

/**
 * Class GetAllCatalogsQuery
 * @package Domain\Catalog\Queries
 */
class GetAllCatalogsQuery
{
    private $excludeCatalog;

    /**
     * GetAllServicesQuery constructor.
     * @param Catalog|null $excludeCatalog
     */
    public function __construct(Catalog $excludeCatalog = null)
    {
        $this->excludeCatalog = $excludeCatalog;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = Catalog::with(['products'])->orderBy('pos');

        if ($this->excludeCatalog) {
            return $query->where('id', '<>', $this->excludeCatalog->id)->get();
        }

        return $query->get();
    }
}
