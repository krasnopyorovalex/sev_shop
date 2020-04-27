<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Page
 * @package App
 */
class Page extends Model
{
    use AutoAliasTrait;

    private const TEMPLATES = [
        'page.page' => 'Информационная',
        'page.index' => 'Главная',
        'page.blog' => 'Блог',
        'page.contacts' => 'Контакты',
    ];

    /**
     * @var array
     */
    protected $fillable = ['slider_id', 'template', 'name', 'title', 'description', 'text', 'alias'];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return BelongsTo
     */
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('page.show', $this->alias);
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return self::TEMPLATES;
    }
}
