<?php

namespace App\Filament\Resources\Seos\Tables;

use App\Filament\Components\Tables\CreatedAtColumn;
use App\Filament\Components\Tables\UpdatedAtColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Composer;
use Livewire\Component;

class SeosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (! is_multi_lang()) {
                    $query->where('language_id', main_lang_id());
                } else {
                    $ids = [main_lang_id()];
                    $ids = array_merge($ids, _settings('additional_languages', []));
                    $query->whereIn('language_id', $ids)->orderByRaw('FIELD(language_id, ' . implode(',', $ids) . ')');
                }
            })
            ->columns([
                TextColumn::make('title')->label(__('seo::admin.seo_title'))->limit(50)->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();
                    if (strlen($state) <= $column->getCharacterLimit()) {
                        return null;
                    }

                    return $state;
                })->toggleable(),
                IconColumn::make('heading')->label(__('seo::admin.seo_heading'))->boolean()->toggleable(),
                IconColumn::make('description')->label(__('seo::admin.seo_description'))->boolean()->toggleable()->default(false),
                IconColumn::make('summary')->label(__('seo::admin.seo_summary'))->toggleable()->boolean(),
                IconColumn::make('content')->label(__('seo::admin.seo_content'))->boolean()->toggleable(),
                UpdatedAtColumn::make(),
                CreatedAtColumn::make(),
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make()
                    // ->outlined()
                    ->link()
                    ->hidden(function (Component $livewire) {
                        if (empty($livewire->record)) {
                            return true;
                        }

                        if (is_multi_lang()) {
                            return $livewire->record->seo()->count() >= count(get_active_languages());
                        }

                        return $livewire->record->seo !== null;
                    }),
                // ->after(function (Component $livewire) {
                //     $livewire->refresh();
                // }),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
