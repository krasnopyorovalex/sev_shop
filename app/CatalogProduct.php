<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\HtmlString;

/**
 * Class CatalogProduct
 * @package App
 */
class CatalogProduct extends Model
{
    use AutoAliasTrait, SoftDeletes;

    private const LABELS = [
        '' => 'Не выбрано',
        'info' => 'Акция!',
        'new' => 'Новинка!'
    ];

    protected $perPage = 20;

    protected $with = ['catalog', 'image'];

    /**
     * @var array
     */
    protected $guarded = ['image'];

    /**
     * @return HasOne
     */
    public function catalog(): HasOne
    {
        return $this->hasOne(Catalog::class, 'id', 'catalog_id');
    }

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('catalog_product.show', $this->alias);
    }

    /**
     * @return HtmlString
     */
    public function getPrice(): HtmlString
    {
        return new HtmlString(sprintf('%s', format_as_price($this->price)));
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return self::LABELS;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getLabelName(string $key)
    {
        return self::LABELS[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isSelectedLabel(string $key): bool
    {
        return $key === $this->label;
    }
}
