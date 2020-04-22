<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;
use InvalidArgumentException;

final class InitStep extends Step
{
    private const MAX_FILE_SIZE = 2000*1024; //2Mb

    public function handle(): void
    {
        if (! $this->verifyCookie()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        $this->status = sprintf('%s' . PHP_EOL . '%s',
            'zip=yes',
            'file_limit=' . self::MAX_FILE_SIZE
        );
    }
}
