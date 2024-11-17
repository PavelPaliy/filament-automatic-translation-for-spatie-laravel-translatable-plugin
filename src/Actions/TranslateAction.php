<?php

namespace Pavelpaliy\AutomaticTranslationForSpatieLaravelTranslatablePlugin\Actions;

use Filament\Actions\Action;
use Illuminate\Contracts\View\View;

class TranslateAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'translate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__("filament-automatic-translation-for-spatie-laravel-translatable-plugin::forms.fields.action"))
            ->modalHeading(__("filament-automatic-translation-for-spatie-laravel-translatable-plugin::forms.fields.title"))
            ->modalContentFooter(fn (): View => view('filament-automatic-translation-for-spatie-laravel-translatable-plugin::filament.translate.component'))
            ->modalSubmitAction(false)
            ->extraModalWindowAttributes(['class' => 'translate-fields-modal'])
            ->modalCancelAction(false);
    }
}
