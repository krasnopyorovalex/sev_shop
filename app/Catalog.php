<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Catalog
 * @package App
 */
class Catalog extends Model
{
    use AutoAliasTrait;

    /**
     * @var array
     */
    protected $guarded = ['image'];

    /**
     * @return HasMany
     */
    public function catalogs(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->orderBy('pos');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(CatalogProduct::class);
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
        return route('catalog.show', $this->alias);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->products()->count()
            ? 'catalog.products'
            : 'catalog.sub_categories';
    }
}
