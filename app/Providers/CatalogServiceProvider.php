<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\ViewComposers\CatalogComposer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

/**
 * Class CatalogServiceProvider
 * @package App\Providers
 */
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['layouts.sections.catalog', 'layouts.partials.categories_menu', 'layouts.sections.filter_panel'], CatalogComposer::class);
    }
}
