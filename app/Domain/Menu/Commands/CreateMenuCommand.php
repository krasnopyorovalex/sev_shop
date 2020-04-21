<?php

declare(strict_types=1);

namespace Domain\Menu\Commands;

use App\Http\Requests\Request;
use App\Menu;

/**
 * Class CreateMenuCommand
 * @package Domain\Menu\Commands
 */
class CreateMenuCommand
{

    private $request;

    /**
     * CreateMenuCommand constructor.
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
        $menu = new Menu();
        $menu->fill($this->request->all());

        return $menu->save();
    }

}
