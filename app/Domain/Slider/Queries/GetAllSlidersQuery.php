<?php

declare(strict_types=1);

namespace Domain\Slider\Queries;

use App\Slider;

/**
 * Class GetAllSlidersQuery
 * @package Domain\Slider\Queries
 */
class GetAllSlidersQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Slider::all();
    }
}
