<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use InvalidArgumentException;

final class FileExportStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $this->status = sprintf('%s', 'success');
    }
}
