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

        $filename = $this->helpFileCommerceService->saveFile($this->request);

        if ((int)$this->request->header('Content-Length') !== self::FILE_LIMIT) {
            $this->helpFileCommerceService->unzip($filename);
        }

        $this->status = sprintf('%s', 'success');
    }
}
