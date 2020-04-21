<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\LinkGeneratorService;
use Illuminate\Support\ServiceProvider;

/**
 * Class LinkGeneratorServiceProvider
 * @package App\Providers
 */
class LinkGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LinkGeneratorService::class, static function () {
            return new LinkGeneratorService();
        });
    }
}
