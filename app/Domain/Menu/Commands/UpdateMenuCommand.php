<?php

declare(strict_types=1);

namespace Domain\Menu\Commands;

use Domain\Menu\Queries\GetMenuByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateMenuCommand
 * @package Domain\Menu\Commands
 */
class UpdateMenuCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdatePageCommand constructor.
     * @param Request $request
     * @param int $id
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $page = $this->dispatch(new GetMenuByIdQuery($this->id));

        return $page->update($this->request->all());
    }

}
