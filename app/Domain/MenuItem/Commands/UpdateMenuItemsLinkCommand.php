<?php

declare(strict_types=1);

namespace Domain\MenuItem\Commands;

use App\MenuItem;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UpdateMenuItemsLinkCommand
 * @package Domain\MenuItem\Commands
 */
class UpdateMenuItemsLinkCommand
{
    /**
     * @var MenuItem
     */
    private $menuItems;

    /**
     * @var string
     */
    private $urlNew;

    /**
     * UpdateMenuItemsLinkCommand constructor.
     * @param Collection $menuItems
     * @param string $urlNew
     */
    public function __construct(Collection $menuItems, string  $urlNew)
    {
        $this->menuItems = $menuItems;
        $this->urlNew = $urlNew;
    }

    public function handle(): void
    {
        $this->menuItems->each(function ($item) {
            return $item->update([
                'link' => $this->urlNew
            ]);
        });
    }

}
