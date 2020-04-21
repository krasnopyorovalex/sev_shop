<?php

namespace Domain\Article\Queries;

use App\Article;
use Domain\Article\DTO\AdjoiningResult;

/**
 * Class GetAdjoiningArticleQuery
 * @package Domain\Article\Queries
 */
class GetAdjoiningArticleQuery
{
    /**
     * @return AdjoiningResult
     */
    public function handle()
    {
        return new AdjoiningResult(Article::orderByDesc('published_at')->get());
    }
}
