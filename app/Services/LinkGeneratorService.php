<?php

declare(strict_types=1);

namespace App\Services;

use App\Catalog;
use Illuminate\Support\Str;
use App\Page;
use App\Article;
use ReflectionClass;
use Log;
use Exception;

/**
 * Class LinkGeneratorService
 * @package App\Services
 */
class LinkGeneratorService
{
    /**
     * @var array
     */
    private $models = [
        Page::class => 'Страницы',
        Catalog::class => 'Каталог',
        Article::class => 'Статьи'
    ];

    /**
     * @var array
     */
    private $result = [];

    /**
     * @return array
     */
    public function getCollection(): array
    {
        foreach ($this->models as $key => $value) {

            try {
                $reflectionClass = (new ReflectionClass($key))->newInstance();
                $module = Str::snake(class_basename($reflectionClass));
                $collection = $reflectionClass::get();

                $this->result[$value] = [
                    'module' => $module,
                    'collections' => $collection
                ];
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $this->result;
    }

    /**
     * @param string $modelName
     * @param string $alias
     * @return string
     */
    public function createLink(string $modelName, string $alias): string
    {
        $route = route($modelName . '.show', ['alias' => $alias], false);

        return str_replace('index', '', $route);
    }

}
