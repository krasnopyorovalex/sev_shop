<?php

declare(strict_types=1);

namespace Domain\Commerce\Jobs;

use Domain\Commerce\Services\HelpFileCommerceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnzipCommercemlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $filename;

    /**
     * Create a new job instance.
     *
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @param HelpFileCommerceService $helpFileCommerceService
     * @return void
     */
    public function handle(HelpFileCommerceService $helpFileCommerceService): void
    {
        $helpFileCommerceService->unzip($this->filename);
    }
}
