<?php

declare(strict_types=1);

namespace Domain\Page\Queries;

use App\Page;

/**
 * Class GetAllPagesQuery
 * @package Domain\Page\Queries
 */
class GetAllPagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Page::all();
    }
}
