<?php

declare(strict_types=1);

namespace Domain\Slider\Commands;

use Domain\Slider\Queries\GetSliderByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteSliderCommand
 * @package Domain\Slider\Commands
 */
class DeleteSliderCommand
{

    use DispatchesJobs;

    private $id;

    /**
     * DeleteSliderCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($this->id));

        \Storage::deleteDirectory('public/slider/' . $this->id);

        return $slider->delete();
    }

}
