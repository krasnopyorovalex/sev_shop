<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\ArticleComposer;

/**
 * Class ArticlesServiceProvider
 * @package App\Providers
 */
class ArticlesServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->make('view')->composer(['page.blog'], ArticleComposer::class);
    }
}
