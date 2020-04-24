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

        \Log::info($this->request->get('filename'));

        \Log::info($this->request->post($this->request->get('filename')));

        $this->status = sprintf('%s', 'success');
    }
}
