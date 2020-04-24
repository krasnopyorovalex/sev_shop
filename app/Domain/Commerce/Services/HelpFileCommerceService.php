<?php

declare(strict_types=1);

namespace Domain\Commerce\Services;

use App\Http\Requests\Request;
use Storage;

class HelpFileCommerceService
{
    /**
     * @param Request $request
     */
    public function saveFile(Request $request): void
    {
        $filename = $request->get('filename');
        $path = storage_path("app/public/1c_catalog/{$filename}");

        $content = $request->getContent();

        file_put_contents($path, $content, FILE_APPEND);
    }

    public function clearDirectory(): void
    {
        Storage::deleteDirectory('public/1c_catalog');
        Storage::makeDirectory('public/1c_catalog');
    }
}
