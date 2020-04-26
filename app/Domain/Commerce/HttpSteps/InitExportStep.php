<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use InvalidArgumentException;

final class InitExportStep extends Step
{
    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        $this->status = sprintf('%s' . PHP_EOL . '%s',
            'zip=yes',
            'file_limit=' . self::FILE_LIMIT
        );
    }
}
