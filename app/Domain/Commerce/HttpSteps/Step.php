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
    protected $cookieName = 'PHPSESSID';

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
    protected function verifyUser(): bool
    {
        $user = $this->request->header('Php-Auth-User');
        $password = $this->request->header('Php-Auth-Pw');

        return $user === config('commerce.user') && $password === config('commerce.password');
    }

    abstract public function handle(): void;
}
