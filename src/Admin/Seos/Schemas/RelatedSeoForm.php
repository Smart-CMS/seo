<?php

namespace SmartCms\Seo\Admin\Seos\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class RelatedSeoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(
                [
                    Tabs::make('seo')->schema(
                        app('lang')->adminLanguages()->map(function ($language) {
                            return Tab::make($language->name)->schema([
                                TextInput::make('title.' . $language->slug)
                                    ->label(__('seo::admin.seo_title'))
                                    ->required()
                                    ->rules('string', 'max:255')
                                    // ->characterLimit(255)
                                    ->maxLength(255),
                                TextInput::make('heading.' . $language->slug)
                                    ->label(__('seo::admin.seo_heading'))
                                    ->rules('string', 'max:255')
                                    // ->characterLimit(255)
                                    ->maxLength(255),
                                Textarea::make('description.' . $language->slug)
                                    ->label(__('seo::admin.seo_description'))
                                    ->rules('string', 'max:255')
                                    // ->characterLimit(255)
                                    ->maxLength(255),
                                Textarea::make('summary.' . $language->slug)
                                    ->label(__('seo::admin.seo_summary'))
                                    ->rules('string', 'max:500')
                                    ->maxLength(500),
                                RichEditor::make('content.' . $language->slug)
                                    ->label(__('seo::admin.seo_content'))
                                    // ->rules('string')
                                    ->columnSpanFull(),
                            ]);
                        })->toArray()
                    )->columnSpanFull(),
                ]
            );
    }
}
