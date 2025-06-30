<?php

namespace App\Filament\Resources\Seos\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SeoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('language_id')->relationship('language', 'name')->hidden(! is_multi_lang())->default(main_lang_id()),
                Hidden::make('language_id')->default(main_lang_id())->hidden(is_multi_lang()),
                TextInput::make('title')
                    ->label(__('core::admin.seo_title'))
                    ->required()
                    ->translatable()
                    ->rules('string', 'max:255')
                    // ->characterLimit(255)
                    ->maxLength(255),
                TextInput::make('heading')
                    ->label(__('core::admin.seo_heading'))
                    ->translatable()
                    ->rules('string', 'max:255')
                    // ->characterLimit(255)
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('core::admin.seo_description'))
                    ->required()
                    ->rules('string', 'max:255')
                    ->translatable()
                    // ->characterLimit(255)
                    ->maxLength(255),
                Textarea::make('summary')
                    ->label(__('core::admin.seo_summary'))
                    ->translatable()
                    ->rules('string', 'max:500')
                    ->maxLength(500),
                RichEditor::make('content')
                    ->label(__('core::admin.seo_content'))
                    ->translatable()
                    // ->rules('string')
                    ->columnSpanFull(),
            ]);
    }
}
