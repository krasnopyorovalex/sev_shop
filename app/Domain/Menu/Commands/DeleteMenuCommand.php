<?php

declare(strict_types=1);

namespace Domain\Menu\Commands;

use Domain\Menu\Queries\GetMenuByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteMenuCommand
 * @package Domain\Menu\Commands
 */
class DeleteMenuCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteCustomerCommand constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $page = $this->dispatch(new GetMenuByIdQuery($this->id));

        return $page->delete();
    }

}
