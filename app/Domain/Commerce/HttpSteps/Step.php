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
     * @return bool
     */
    protected function verifyCookie(): bool
    {
        [$cookieName, $cookieValue] = $this->request->header('Cookie');

        return $cookieName === $this->cookieName && cookie($this->cookieName) === $cookieValue;
    }

    abstract public function handle(): void;
}
