<?php

declare(strict_types=1);

namespace Domain\Catalog\Commands;

use Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Catalog;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateCatalogCommand
 * @package Domain\Catalog\Commands
 */
class CreateCatalogCommand
{
    use DispatchesJobs;

    private $request;

    /**
     * CreateCatalogCommand constructor.
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
        $catalog = new Catalog();
        $catalog->fill($this->request->all());
        $catalog->save();

        if($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $catalog->id, Catalog::class));
        }

        return true;
    }

}
