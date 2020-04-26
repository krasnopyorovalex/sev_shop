<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderCatalogProduct extends Pivot
{
    public $timestamps = false;
}
