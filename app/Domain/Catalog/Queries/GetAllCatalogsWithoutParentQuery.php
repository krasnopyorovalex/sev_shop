<?php

declare(strict_types=1);

namespace Domain\Catalog\Queries;

use App\Catalog;

/**
 * Class GetAllCatalogsWithoutParentQuery
 * @package Domain\Catalog\Queries
 */
class GetAllCatalogsWithoutParentQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Catalog::with(['products','catalogs'])->where('parent_id', null)->orderBy('pos')->get();
    }
}
