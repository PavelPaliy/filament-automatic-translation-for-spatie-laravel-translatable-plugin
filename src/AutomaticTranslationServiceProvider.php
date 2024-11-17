<?php

namespace Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin;
use Filament\Support\Assets\Js;
use Livewire\Livewire;
use Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Livewire\ModalForTranslation;
use Filament\Support\Facades\FilamentAsset;

class AutomaticTranslationServiceProvider extends \Spatie\LaravelPackageTools\PackageServiceProvider
{

    public function configurePackage(\Spatie\LaravelPackageTools\Package $package): void
    {
        $package->name('filament-automatic-translation-for-spatie-laravel-translatable-plugin')
            ->hasViews('ifrs')
        ->hasRoute('web');
    }

    public function boot(): void
    {
        parent::boot();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-automatic-translation-for-spatie-laravel-translatable-plugin');

        FilamentAsset::register([
            Js::make('iframe-for-translate', __DIR__ .'/../resources/js/filament/iframe-for-translate.js')->loadedOnRequest(),
        ]);
        define("AUTOMATIC_TRANSLATION_ROOT_DIR", __DIR__);
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-automatic-translation-for-spatie-laravel-translatable-plugin');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/filament-automatic-translation-for-spatie-laravel-translatable-plugin'),
        ], 'filament-automatic-translation-for-spatie-laravel-translatable-plugin');

    }

    public function packageBooted(): void
    {
        Livewire::component('modal-for-translation', ModalForTranslation::class);
    }
}
