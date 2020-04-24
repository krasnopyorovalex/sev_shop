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
        $content = $request->getContent();
        Storage::put("public/1c_catalog/{$filename}", $content);
    }

    public function clearDirectory(): void
    {
        Storage::deleteDirectory('public/1c_catalog');
        Storage::makeDirectory('public/1c_catalog');
    }
}
