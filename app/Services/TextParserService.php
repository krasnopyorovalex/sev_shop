<?php

declare(strict_types=1);

namespace App\Services;

use Domain\Article\Queries\GetAllArticlesQuery;
use Domain\Catalog\Queries\GetAllCatalogsWithoutParentQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class TextParserService
 * @package App\Services
 */
class TextParserService
{
    use DispatchesJobs;

    private const PAGINATE_LIMIT = 10;

    /**
     * @param Model $entity
     * @return string|string[]|null
     */
    public function parse(Model $entity)
    {
        return preg_replace_callback_array(
            [
                '#(<p(.*)>)?{articles}(<\/p>)?#' => function () {
                    $articles = $this->dispatch(new GetAllArticlesQuery(true, self::PAGINATE_LIMIT));

                    return view('layouts.shortcodes.articles', ['articles' => $articles]);
                },
                '#(<p(.*)>)?{catalog}(<\/p>)?#' => function () {
                    $catalogs = $this->dispatch(new GetAllCatalogsWithoutParentQuery());

                    return view('layouts.shortcodes.catalogs', [
                        'catalogs' => $catalogs
                    ]);
                }
            ],
            $entity->text
        );
    }

}
