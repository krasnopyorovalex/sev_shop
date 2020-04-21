<?php

declare(strict_types=1);

namespace Domain\Page\Commands;

use Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreatePageCommand
 * @package Domain\Page\Commands
 */
class CreatePageCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreatePageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $page = new Page();
        $page->fill($this->request->all());
        $page->save();

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $page->id, Page::class));
        }

        return true;
    }

}
