<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use App\Http\Requests\Request;
use Domain\Commerce\Services\HelpFileCommerceService;
use InvalidArgumentException;

final class InitStep extends Step
{
    /**
     * @var HelpFileCommerceService
     */
    private $helpFileCommerceService;

    /**
     * InitStep constructor.
     * @param Request $request
     * @param HelpFileCommerceService $helpFileCommerceService
     */
    public function __construct(Request $request, HelpFileCommerceService $helpFileCommerceService)
    {
        $this->helpFileCommerceService = $helpFileCommerceService;
        parent::__construct($request);
    }

    public function handle(): void
    {
        if (! $this->verifyUser()) {
            throw new InvalidArgumentException('Bad value cookie given:(');
        }

        $this->helpFileCommerceService->clearDirectory();

        $this->status = sprintf('%s' . PHP_EOL . '%s',
            'zip=yes',
            'file_limit=' . self::FILE_LIMIT
        );
    }
}
