<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Redirect;

/**
 * Class GetAllRedirectsQuery
 * @package Domain\Redirect\Queries
 */
class GetAllRedirectsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Redirect::all();
    }
}
