<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\UploadCkeditorImageService;
use Illuminate\Support\ServiceProvider;

/**
 * Class UploadCkeditorImageServiceProvider
 * @package App\Providers
 */
class UploadCkeditorImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UploadCkeditorImageService::class, static function () {
            return new UploadCkeditorImageService();
        });
    }
}
