<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

class InitStep extends Step
{
    /**
     * @return mixed
     */
    public function handle()
    {
        $this->verifyCookie();
    }
}
