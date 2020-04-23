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
    private static $cached;

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (! self::$cached) {
            self::$cached = Catalog::with(['products','catalogs'])->where('parent_id', null)->orderBy('pos')->get();
        }

        return self::$cached;
    }
}
