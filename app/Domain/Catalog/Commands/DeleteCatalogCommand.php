<?php

declare(strict_types=1);

namespace Domain\Catalog\Commands;

use Domain\Catalog\Queries\GetCatalogByIdQuery;
use Domain\CatalogProduct\Commands\DeleteCatalogProductCommand;
use Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteCatalogCommand
 * @package Domain\Catalog\Commands
 */
class DeleteCatalogCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteCatalogCommand constructor.
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
        $catalog = $this->dispatch(new GetCatalogByIdQuery($this->id));

        if($catalog->image) {
            $this->dispatch(new DeleteImageCommand($catalog->image));
        }

        foreach ($catalog->products as $product) {
            $this->dispatch(new DeleteCatalogProductCommand($product->id));
        }

        if ($catalog->catalogs) {
            foreach ($catalog->catalogs as $childCatalog) {
                if ($childCatalog->products) {
                    foreach ($childCatalog->products as $childProduct) {
                        $this->dispatch(new DeleteCatalogProductCommand($childProduct->id));
                    }
                }

                $childCatalog->delete();
            }
        }

        return $catalog->delete();
    }

}
