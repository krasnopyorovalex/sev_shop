<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Article\Queries\GetAllArticlesQuery;
use Domain\Catalog\Queries\GetAllCatalogsQuery;
use Domain\Page\Queries\GetAllPagesQuery;
use Illuminate\Http\Response;

/**
 * Class SitemapController
 * @package App\Http\Controllers
 */
class SitemapController extends Controller
{
    /**
     * @return Response
     */
    public function xml(): Response
    {
        $pages = $this->dispatch(new GetAllPagesQuery());
        $articles = $this->dispatch(new GetAllArticlesQuery(true));
        $catalog = $this->dispatch(new GetAllCatalogsQuery());

        return response()
            ->view('sitemap.index', [
                'pages' => $pages,
                'articles' => $articles,
                'catalog' => $catalog
            ])
            ->header('Content-Type', 'text/xml');
    }
}
