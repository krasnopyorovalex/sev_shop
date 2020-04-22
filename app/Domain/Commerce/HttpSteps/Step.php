<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

abstract class Step
{
    /**
     * @var string
     */
    protected $status = 'failure';

    /**
     * @var string
     */
    protected $cookieName = 'auth.code';

    abstract public function handle();

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param $cookie
     * @return bool
     */
    protected function verifyCookie($cookie): bool
    {
        return cookie($this->cookieName) === $cookie;
    }
}
