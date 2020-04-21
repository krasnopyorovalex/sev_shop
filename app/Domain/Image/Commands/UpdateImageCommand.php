<?php

declare(strict_types=1);

namespace Domain\Image\Commands;

use Domain\Image\Queries\GetImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateImageCommand
 * @package Domain\Image\Commands
 */
class UpdateImageCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdatePageCommand constructor.
     * @param Request $request
     * @param int $id
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $image = $this->dispatch(new GetImageByIdQuery($this->id));

        return $image->update($this->request->all());
    }

}
