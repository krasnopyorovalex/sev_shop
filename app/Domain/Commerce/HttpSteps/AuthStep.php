<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

final class AuthStep extends Step
{
    public function handle(): void
    {
        $cookieValue = $this->request->session()->getId();

        $this->status = sprintf('%s' . PHP_EOL . '%s' . PHP_EOL . '%s',
            'success',
            $this->cookieName,
            $cookieValue
        );
    }
}
