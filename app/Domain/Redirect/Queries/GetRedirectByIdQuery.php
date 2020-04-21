<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Redirect;

/**
 * Class GetRedirectByIdQuery
 * @package Domain\Redirect\Queries
 */
class GetRedirectByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetRedirectByIdQuery constructor.
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
        return Redirect::findOrFail($this->id);
    }
}
