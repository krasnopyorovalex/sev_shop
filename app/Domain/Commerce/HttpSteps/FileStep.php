<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;
use InvalidArgumentException;

final class FileStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyCookie()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        \Log::info('$this->request->post()');

        $this->status = sprintf('%s', 'success');
    }
}
