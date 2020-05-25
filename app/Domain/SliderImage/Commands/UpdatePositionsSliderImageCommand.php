<?php

declare(strict_types=1);

namespace Domain\SliderImage\Commands;

use Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsSliderImageCommand
 * @package Domain\SliderImage\Commands
 */
class UpdatePositionsSliderImageCommand
{

    use DispatchesJobs;

    private $request;

    /**
     * UpdatePositionsSliderImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if (is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetSliderImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
