<?php

namespace SmartCms\Seo\Traits;

use SmartCms\Seo\Models\Seo;

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
}
