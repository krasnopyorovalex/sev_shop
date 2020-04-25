<?php

declare(strict_types=1);

namespace Domain\Commerce\Jobs;

use Domain\Commerce\Factory\ParseCommercemlSimpleFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseCommercemlJob implements ShouldQueue
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
     * @return void
     */
    public function handle(): void
    {
        ParseCommercemlSimpleFactory::factory($this->filename);
    }
}
