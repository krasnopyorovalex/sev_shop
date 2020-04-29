<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    protected $with = ['catalogProducts'];

    /**
     * @return BelongsToMany
     */
    public function catalogProducts(): BelongsToMany
    {
        return $this->belongsToMany(CatalogProduct::class, 'order_catalog_products')
            ->using(OrderCatalogProduct::class)
            ->withPivot([
                'total',
                'quantity',
            ]);
    }
}
