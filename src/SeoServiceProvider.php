<?php

namespace SmartCms\Seo;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
