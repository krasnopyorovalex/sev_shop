<?php

declare(strict_types=1);

namespace Domain\SliderImage\Queries;

use App\Slider;

/**
 * Class GetAllSliderImagesQuery
 * @package Domain\Gallery\Queries
 */
class GetAllSliderImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Slider::all();
    }
}
