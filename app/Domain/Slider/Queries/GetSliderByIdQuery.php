<?php

declare(strict_types=1);

namespace Domain\Slider\Queries;

use App\Slider;

/**
 * Class GetSliderByIdQuery
 * @package Domain\Page\Queries
 */
class GetSliderByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetSliderByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Slider::with(['images'])->findOrFail($this->id);
    }
}
