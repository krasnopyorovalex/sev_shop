<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use Illuminate\Support\Str;

final class AuthStep extends Step
{
    public function handle(): void
    {
        $cookieValue = Str::random();
        $this->request->session()->put($this->cookieName, $cookieValue);

        \Log::info('real: ' . $this->request->session()->get($this->cookieName));

        $this->status = sprintf('%s' . PHP_EOL . '%s' . PHP_EOL . '%s',
            'success',
            $this->cookieName,
            $cookieValue
        );
    }
}
