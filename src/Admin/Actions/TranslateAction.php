<?php

namespace SmartCms\Seo\Admin\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class TranslateAction
{
    public static function make(Schema $schema, string $field, string $fieldClass, bool $required = false): Action
    {
        return Action::make('translate')->icon(Heroicon::OutlinedLanguage)->schema(function () use ($fieldClass, $required): array {
            return lang()->adminLanguages()->filter(fn ($language) => $language->slug !== main_lang())->map(function ($language) use ($fieldClass, $required) {
                return $fieldClass::make($language->slug)->label($language->name)->required($required);
            })->toArray();
        })->fillForm(function () use ($schema, $field): array {
            return $schema->getRecord()->seo()->get()->mapWithKeys(function ($seo) use ($field) {
                return [
                    $seo->language->slug => $seo?->$field,
                ];
            })->toArray();
        })->action(function (array $data) use ($schema, $field): void {
            foreach ($data as $language => $value) {
                $schema->getRecord()->seo()->updateOrCreate(['language_id' => lang()->getBySlug($language)->id], [$field => $value]);
            }
            Notification::make()->success()->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))->send();
        });
    }
}
