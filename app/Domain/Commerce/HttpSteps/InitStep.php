<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

final class InitStep extends Step
{
    private const MAX_FILE_SIZE = 2000*1024; //2Mb

    public function handle(): void
    {
        //$this->verifyCookie();

        \Log::info((string)$this->request->header('Cookie'));

        $this->status = sprintf('%s' . PHP_EOL . '%s',
            'zip=yes',
            'file_limit=' . self::MAX_FILE_SIZE
        );
    }
}
