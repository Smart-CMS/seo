<?php

namespace SmartCms\Seo\Admin\Seos\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use SmartCms\Seo\Admin\Actions\TranslateAction;

class RelatedSeoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('seo::admin.seo_title'))
                    ->required()
                    ->rules('string', 'max:255')
                    ->suffixAction(TranslateAction::make($schema, 'title', TextInput::class, true))
                    // ->characterLimit(255)
                    ->maxLength(255),
                TextInput::make('heading')
                    ->label(__('seo::admin.seo_heading'))
                    ->rules('string', 'max:255')
                    ->suffixAction(TranslateAction::make($schema, 'heading', TextInput::class))
                    // ->characterLimit(255)
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('seo::admin.seo_description'))
                    ->rules('string', 'max:255')
                    ->hintAction(TranslateAction::make($schema, 'description', Textarea::class))
                    // ->characterLimit(255)
                    ->maxLength(255),
                Textarea::make('summary')
                    ->label(__('seo::admin.seo_summary'))
                    ->hintAction(TranslateAction::make($schema, 'summary', Textarea::class))
                    ->rules('string', 'max:500')
                    ->maxLength(500),
                RichEditor::make('content')
                    ->label(__('seo::admin.seo_content'))
                    ->hintAction(TranslateAction::make($schema, 'content', RichEditor::class))
                    // ->rules('string')
                    ->columnSpanFull(),
            ]);
    }
}
