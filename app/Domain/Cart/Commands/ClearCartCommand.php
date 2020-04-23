<?php

declare(strict_types=1);

namespace Domain\Cart\Commands;

/**
 * Class ClearCartCommand
 * @package Domain\Cart\Commands
 */
class ClearCartCommand
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return app('cart')->clear();
    }
}
