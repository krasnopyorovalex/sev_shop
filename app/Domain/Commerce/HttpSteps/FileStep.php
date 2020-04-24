<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use InvalidArgumentException;

final class FileStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $filename = $this->request->get('filename');
        $path = storage_path("app/public/1c_catalog/{$filename}");

        $content = $this->request->getContent();

        file_put_contents($path, $content, FILE_APPEND);

        $this->status = sprintf('%s', 'success');
    }
}
