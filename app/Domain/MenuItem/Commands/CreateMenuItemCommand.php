<?php

declare(strict_types=1);

namespace Domain\MenuItem\Commands;

use App\Http\Requests\Request;
use App\MenuItem;

/**
 * Class CreateMenuItemCommand
 * @package Domain\MenuItem\Commands
 */
class CreateMenuItemCommand
{

    private $request;

    /**
     * CreateMenuItemCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $menuItem = new MenuItem();
        $menuItem->fill($this->request->all());

        return $menuItem->save();
    }

}
