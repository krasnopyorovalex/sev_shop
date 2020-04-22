<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

final class FileStep extends Step
{
    public function handle(): void
    {
        //$this->verifyCookie();

        \Log::info($this->request->post());

        $this->status = sprintf('%s', 'success');
    }
}
