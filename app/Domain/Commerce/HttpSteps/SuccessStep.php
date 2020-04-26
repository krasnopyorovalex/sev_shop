<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use InvalidArgumentException;
use Log;

final class SuccessStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        Log::info("Type: {$this->request->get('type')}, Status: {$this->request->get('mode')}");
    }
}
