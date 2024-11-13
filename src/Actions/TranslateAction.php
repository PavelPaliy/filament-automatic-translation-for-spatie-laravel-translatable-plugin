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

        $this->label(__("automatic-translation::forms.fields.action"))
            ->modalHeading(__("automatic-translation::forms.fields.title"))
            ->modalContentFooter(fn (): View => view('automatic-translation::filament.translate.component'))
            ->modalSubmitAction(false)
            ->extraModalWindowAttributes(['class' => 'translate-fields-modal'])
            ->modalCancelAction(false);
    }
}
