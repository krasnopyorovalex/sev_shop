<?php

namespace Domain\Article\Commands;

use Domain\Article\Queries\GetArticleByIdQuery;
use Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteArticleCommand
 * @package Domain\Article\Commands
 */
class DeleteArticleCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteArticleCommand constructor.
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
        $article = $this->dispatch(new GetArticleByIdQuery($this->id));

        if($article->image) {
            $this->dispatch(new DeleteImageCommand($article->image));
        }

        return $article->delete();
    }

}
