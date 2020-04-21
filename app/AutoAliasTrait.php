<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Str;

trait AutoAliasTrait
{
    /**
     * @param string $value
     */
    public function setAliasAttribute(string $value): void
    {
        $this->attributes['alias'] = Str::slug($value, '-', 'ru');
    }
}
