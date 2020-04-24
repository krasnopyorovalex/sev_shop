<?php

declare(strict_types=1);

namespace Domain\Commerce\Services;

use App\Http\Requests\Request;
use Storage;
use ZipArchive;

class HelpFileCommerceService
{
    /**
     * @param Request $request
     * @return string
     */
    public function saveFile(Request $request): string
    {
        $filename = $request->get('filename');
        $path = storage_path("app/public/1c_catalog/{$filename}");

        $content = $request->getContent();

        file_put_contents($path, $content, FILE_APPEND);

        return (string)$filename;
    }

    public function clearDirectory(): void
    {
        Storage::deleteDirectory('public/1c_catalog');
        Storage::makeDirectory('public/1c_catalog');
    }

    /**
     * @param string $filename
     */
    public function unzip(string $filename): void
    {
        chmod($filename, 0755);

        $zip = new ZipArchive();

        if ($zip->open(storage_path($filename))) {
            $zip->extractTo(storage_path('app/public/1c_catalog'));
            $zip->close();
        }

        Storage::delete($filename);
    }
}
