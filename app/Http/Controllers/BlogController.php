<?php

namespace App\Http\Controllers;

use Domain\Article\Queries\GetArticleByAliasQuery;
use Domain\Article\Queries\GetAdjoiningArticleQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * @param string $alias
     * @return Application|Factory|View
     */
    public function show(string $alias)
    {
        $article = $this->dispatch(new GetArticleByAliasQuery($alias));
        $adjoiningArticles = $this->dispatch(new GetAdjoiningArticleQuery());

        return view('article.index', [
            'article' => $article,
            'next' => $adjoiningArticles->nextOrFirst($article),
            'prev' => $adjoiningArticles->prevOrLast($article)
        ]);
    }
}
