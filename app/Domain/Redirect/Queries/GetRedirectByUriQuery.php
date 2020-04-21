<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Redirect;

/**
 * Class GetRedirectByIdQuery
 * @package Domain\Redirect\Queries
 */
class GetRedirectByUriQuery
{
    /**
     * @var string
     */
    private $uri;

    /**
     * GetRedirectByUriQuery constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Redirect::where('url_old', $this->uri)->first();
    }
}
