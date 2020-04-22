<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Illuminate\Support\Str;

final class AuthStep extends Step
{
    public function handle(): void
    {
        $session = session($this->cookieName, Str::random());

        $this->status = sprintf('%s' . PHP_EOL . '%s' . PHP_EOL . '%s',
            'success',
            $this->cookieName,
            $session->get($this->cookieName)
        );
    }
}
