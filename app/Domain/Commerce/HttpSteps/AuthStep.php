<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Cache;
use Illuminate\Support\Str;

final class AuthStep extends Step
{
    public function handle(): void
    {
        $cookieValue = Str::random();
        Cache::put($this->cookieName, $cookieValue);

        $this->status = sprintf('%s' . PHP_EOL . '%s' . PHP_EOL . '%s',
            'success',
            $this->cookieName,
            $cookieValue
        );
    }
}
