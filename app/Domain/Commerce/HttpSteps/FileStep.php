<?php

declare(strict_types=1);

namespace Domain\Commerce\HttpSteps;

use App\Http\Requests\Request;
use Domain\Commerce\Jobs\UnzipCommercemlJob;
use Domain\Commerce\Services\HelpFileCommerceService;
use InvalidArgumentException;

final class FileStep extends Step
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
            throw new InvalidArgumentException('Bad user login or password given:(');
        }

        $filename = $this->helpFileCommerceService->saveFile($this->request);

        $contentLength = (int)$this->request->header('Content-Length');

        if ($contentLength !== self::FILE_LIMIT) {
            UnzipCommercemlJob::dispatch($filename);
        }

        \Log::info($filename);

        $this->status = sprintf('%s', 'success');
    }
}
