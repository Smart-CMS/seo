<?php

namespace SmartCms\Seo\Admin\Seos\Pages;

use App\Filament\Resources\Seos\SeoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSeo extends CreateRecord
{
    protected static string $resource = SeoResource::class;
}
