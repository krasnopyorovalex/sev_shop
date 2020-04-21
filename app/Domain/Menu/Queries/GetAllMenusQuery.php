<?php

declare(strict_types=1);

namespace Domain\Menu\Queries;

use App\Menu;

/**
 * Class GetAllMenusQuery
 * @package Domain\Menu\Queries
 */
class GetAllMenusQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Menu::all();
    }
}
