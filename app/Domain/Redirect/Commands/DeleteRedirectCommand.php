<?php

declare(strict_types=1);

namespace Domain\Redirect\Commands;

use Domain\Redirect\Queries\GetRedirectByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteRedirectCommand
 * @package Domain\Redirect\Commands
 */
class DeleteRedirectCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteRedirectCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
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
        $redirect = $this->dispatch(new GetRedirectByIdQuery($this->id));

        return $redirect->delete();
    }

}
