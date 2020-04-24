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

        //$this->helpFileCommerceService->clearDirectory();

        $this->helpFileCommerceService->saveFile($this->request);

        $this->status = sprintf('%s', 'success');
    }
}
