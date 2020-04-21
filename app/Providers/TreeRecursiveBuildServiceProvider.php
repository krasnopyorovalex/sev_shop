<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\TreeRecursiveBuildService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TreeRecursiveBuildServiceProvider
 * @package App\Providers
 */
class TreeRecursiveBuildServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TreeRecursiveBuildService::class, static function () {
            return new TreeRecursiveBuildService();
        });
    }
}
