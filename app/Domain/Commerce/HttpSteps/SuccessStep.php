<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Domain\Order\Commands\UpdateStatusOrdersCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;
use InvalidArgumentException;
use Log;

final class SuccessStep extends Step
{
    use DispatchesJobs;

    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        $this->dispatch(new UpdateStatusOrdersCommand);

        Log::info("Type: {$this->request->get('type')}, Status: {$this->request->get('mode')}");
    }
}
