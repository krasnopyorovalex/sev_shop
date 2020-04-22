<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use App\Http\Requests\Request;

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

    /**
     * @var Request
     */
    protected $request;

    /**
     * Step constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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

    abstract public function handle(): void;
}
