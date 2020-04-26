<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;
use Domain\Commerce\Jobs\ParseCommercemlJob;
use InvalidArgumentException;

final class ImportStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $filename = $this->request->get('filename');

        ParseCommercemlJob::dispatch($filename);

        $this->status = sprintf('%s', 'success');
    }
}
