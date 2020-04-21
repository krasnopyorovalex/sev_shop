<?php

declare(strict_types=1);

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register():void
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::include('includes.input', 'input');
        Blade::include('includes.submit_btn', 'submit_btn');
        Blade::include('includes.textarea', 'textarea');
        Blade::include('includes.checkbox', 'checkbox');
        Blade::include('includes.imageInput', 'imageInput');
        Blade::include('includes.dateInput', 'dateInput');
        Blade::include('includes.selectLink', 'selectLink');
        Blade::include('includes.select', 'select');

        setlocale(LC_TIME, 'ru_RU.UTF-8');
    }
}
