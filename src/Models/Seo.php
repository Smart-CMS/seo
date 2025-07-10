<?php

namespace SmartCms\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

/**
 * Class Seo
 *
 * @property int $id The unique identifier for the model.
 * @property string $title The SEO title.
 * @property string $heading The page heading.
 * @property string $summary The summary or excerpt.
 * @property string $content The main content.
 * @property string $description The meta description.
 * @property string $keywords The meta keywords.
 * @property string $seoable_type The type of model this SEO belongs to.
 * @property int $seoable_id The ID of the model this SEO belongs to.
 * @property \DateTime $created_at The date and time when the model was created.
 * @property \DateTime $updated_at The date and time when the model was last updated.
 * @property-read mixed $seoable The model this SEO belongs to.
 */
class Seo extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    protected $casts = [
        'title' => 'array',
        'heading' => 'array',
        'summary' => 'array',
        'content' => 'array',
        'description' => 'array',
        'keywords' => 'array',
    ];

    protected array $translatable = [
        'title',
        'heading',
        'summary',
        'content',
        'description',
        'keywords',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTable()
    {
        return config('seo.table_name', 'seos');
    }
}
