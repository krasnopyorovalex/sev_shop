<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\TextParserService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TextParserServiceProvider
 * @package App\Providers
 */
class TextParserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TextParserService::class, static function () {
            return new TextParserService();
        });
    }
}
