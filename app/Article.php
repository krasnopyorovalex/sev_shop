<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Article
 * @package App
 */
class Article extends Model
{
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * @var array
     */
    protected $fillable = ['name', 'title', 'description', 'text', 'preview', 'alias', 'is_published', 'published_at'];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('article.show', $this->alias);
    }
}
