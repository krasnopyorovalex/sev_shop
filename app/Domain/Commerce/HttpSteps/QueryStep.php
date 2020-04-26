<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use InvalidArgumentException;

final class QueryStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        $this->isXml = true;
    }
}
