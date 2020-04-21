<?php

namespace App\Http\ViewComposers;

use Domain\Article\Queries\GetAllArticlesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ArticleComposer
 * @package App\Http\ViewComposers
 */
class ArticleComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $articles = $this->dispatch(new GetAllArticlesQuery(true, 10));

        $view->with('articles', $articles);
    }
}
