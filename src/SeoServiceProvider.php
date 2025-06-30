<?php

namespace SmartCms\Seo;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SmartCms\Seo\Commands\SeoCommand;
use SmartCms\Seo\Testing\TestsSeo;

class SeoServiceProvider extends PackageServiceProvider
{
    public static string $name = 'seo';

    public static string $viewNamespace = 'seo';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasCommands([])
            ->hasConfigFile()
            ->hasMigration('create_seo_table')
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('smart-cms/seo');
            });
    }

    public function packageRegistered(): void {}
}
