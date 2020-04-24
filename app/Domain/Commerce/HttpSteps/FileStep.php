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

        $this->request->file()->storeAs('public/1c_catalog', $filename);

        $this->status = sprintf('%s', 'success');
    }
}
