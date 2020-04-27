<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use App\Http\Requests\Request;

abstract class Step
{
    /**
     * file limit size in bytes from 1c = 200kb
     */
    protected const FILE_LIMIT = 204800;
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
     * @var bool
     */
    protected $isXml = false;

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
    public function isXml(): bool
    {
        return $this->isXml;
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
