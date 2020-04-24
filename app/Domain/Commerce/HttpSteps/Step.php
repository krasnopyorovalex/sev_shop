<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use App\Http\Requests\Request;
use Domain\Commerce\Services\HelpFileCommerceService;

abstract class Step
{
    protected const FILE_LIMIT = 20480;
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
     * @var HelpFileCommerceService
     */
    protected $helpFileCommerceService;

    /**
     * Step constructor.
     * @param Request $request
     * @param HelpFileCommerceService $helpFileCommerceService
     */
    public function __construct(Request $request, HelpFileCommerceService $helpFileCommerceService)
    {
        $this->request = $request;
        $this->helpFileCommerceService = $helpFileCommerceService;
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
