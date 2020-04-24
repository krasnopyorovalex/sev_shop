<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;
use InvalidArgumentException;
use Storage;

final class FileStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $files = Storage::allFiles(storage_path('app/public/1c_catalog'));
        Storage::delete($files);

        $filename = $this->request->get('filename');
        $path = storage_path("app/public/1c_catalog/{$filename}");

        $content = $this->request->getContent();

        Storage::put($path, $content);

        //file_put_contents($path, $content, FILE_APPEND);

        $this->status = sprintf('%s', 'success');
    }
}
