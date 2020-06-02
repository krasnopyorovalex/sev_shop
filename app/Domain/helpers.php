<?php

use App\Catalog;
use Illuminate\Support\HtmlString;

if (! function_exists('svg')) {
    function svg($symbol): HtmlString
    {
        return new HtmlString(
            '<svg class="icon">
                <use xlink:href="' . asset("img/symbols.svg#{$symbol}") . '"></use>
            </svg>'
        );
    }
}

if (! function_exists('loop_index_by_pagination')) {
    function loop_index_by_pagination($iteration, $paginateStep = 15): int {
        $page = request('page') ? request('page') - 1 : 0;
        return (int) $page * $paginateStep + $iteration;
    }
}

if (! function_exists('is_active_link')) {
    function is_active_link(string $link): HtmlString
    {
        return $link === request()->fullUrl()
            ? new HtmlString(' class="active"')
            : new HtmlString('');
    }
}

if (! function_exists('add_css_class')) {
    /**
     * @param $item
     * @return string
     */
    function add_css_class($item)
    {
        $classes = [];

        if (count($item->menuItems)) {
            $classes[] = 'has__child';
        }

        $path = urldecode(request()->path());

        if (trim($item->link,'/') === $path || $path === $item->link) {
            $classes[] = 'active';
        }
        return count($classes) ? ' class="'. implode(' ', $classes) .'"' : '';
    }
}

if (! function_exists('build_root_child_select')) {
    /**
     * @param $collection
     * @param null $selected
     * @return string
     */
    function build_root_child_select($collection, $selected = null)
    {
        $returnedArray = [];

        foreach ($collection as $item) {
            if (!$item['parent_id']) {
                $returnedArray[] = $item;
                continue;
            }
            $returnedArray['child_' . $item['parent_id']][] = $item;
        }

        return build_options($returnedArray, $selected);
    }
}

if (! function_exists('build_options')) {
    /**
     * @param array $array
     * @param $selected
     * @param string $html
     * @param string $step
     * @param array $helpArray
     * @return string
     */
    function build_options(array $array, $selected, $html = '', $step = '', $helpArray = [])
    {
        $originArray = count($helpArray) ? $helpArray : $array;
        foreach ($array as $item) {
            if (!is_array($item)) {

                $html .= '<option value="' . $item->id . '"' . ($selected === $item->id ? 'selected=""' : '') . '>' . $step . $item->name . '</option>' . PHP_EOL;

                if (isset($originArray['child_' . $item->id])) {
                    $html = build_options($originArray['child_' . $item->id], $selected, $html, $step . '**', $array);
                }
            }
        }
        return $html;
    }
}

if (! function_exists('is_current')) {
    function is_current(Catalog $catalog): bool
    {
        $urls = $catalog->catalogs->map(static function ($item) {
            return $item->url;
        });

        return in_array(request()->fullUrl(), $urls->toArray(), true);
    }
}

if (! function_exists('format_as_price')) {
    function format_as_price(float $price): float
    {
       return number_format($price, 2, '.', '');
    }
}
