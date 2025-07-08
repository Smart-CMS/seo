<?php

namespace SmartCms\Seo\Traits;

use SmartCms\Seo\Models\Seo;
use SmartCms\Seo\Services\StaticCache;

/**
 * Trait HasSeo
 */
trait HasSeo
{
    protected static $requestCache = [];

    /**
     * Get the SEO relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    /**
     * Get the SEO for the current entity.
     *
     * @param  int|null  $languageId  The language ID to get the SEO for.
     * @return \SmartCms\Seo\Models\Seo
     */
    public function getSeo($languageId = null)
    {
        $languageId = $languageId ?? current_lang_id();

        // $namespace = self::class . '.seo';
        // $key = $this->getKey();
        // if (StaticCache::has($namespace, $key)) {
        //     return StaticCache::get($namespace, $key);
        // }
        return once(function () use ($languageId) {
            return $this->seo()->where('language_id', $languageId)->first() ?? new Seo;
        });

        // $seo = $this->seo()->where('language_id', $languageId)->first() ?: new Seo;
        // StaticCache::put($namespace, $key, $seo);

        return $seo;
    }
}
