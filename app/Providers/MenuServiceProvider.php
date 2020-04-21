<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container;
use App\Http\ViewComposers\MenuComposer;

/**
 * Class MenuServiceProvider
 * @package App\Providers
 */
class MenuServiceProvider extends ServiceProvider
{
    /**
     * @throws Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer('layouts.app', MenuComposer::class);
    }
}
