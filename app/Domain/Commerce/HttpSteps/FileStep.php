<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Domain\Commerce\Jobs\UnzipCommercemlJob;
use InvalidArgumentException;

final class FileStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $filename = $this->helpFileCommerceService->saveFile($this->request);

        $contentLength = (int)$this->request->header('Content-Length');

        if ($contentLength !== self::FILE_LIMIT) {
            UnzipCommercemlJob::dispatch($filename);
        }

        $this->status = sprintf('%s', 'success');
    }
}
