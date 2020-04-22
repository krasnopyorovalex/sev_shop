<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Illuminate\Support\Str;

class AuthStep extends Step
{
    public function handle(): void
    {
        $cookie = cookie($this->cookieName, Str::random());

        $this->status = sprintf('%s' . PHP_EOL . '%s' . PHP_EOL . '%s',
            'success',
            $cookie->getName(),
            $cookie->getValue()
        );
    }
}
