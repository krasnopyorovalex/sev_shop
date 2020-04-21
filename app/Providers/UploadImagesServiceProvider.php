<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\UploadImagesService;
use Illuminate\Support\ServiceProvider;

/**
 * Class UploadImagesServiceProvider
 * @package App\Providers
 */
class UploadImagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UploadImagesService::class, static function () {
            return new UploadImagesService();
        });
    }
}
