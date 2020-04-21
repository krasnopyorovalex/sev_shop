<?php

declare(strict_types=1);

namespace Domain\MenuItem\Commands;

use Domain\MenuItem\Queries\GetMenuItemByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateMenuItemCommand
 * @package Domain\MenuItem\Commands
 */
class UpdateMenuItemCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateMenuItemCommand constructor.
     * @param int $id
     * @param Request $request
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
        $menuItem = $this->dispatch(new GetMenuItemByIdQuery($this->id));

        return $menuItem->update($this->request->all());
    }

}
